from flask import Flask, render_template, session, request, abort, redirect, flash, url_for
import sqlite3 as sql
import os
import random
import datetime 
import time


app = Flask(__name__)


fullname=''
name = ''
availble = False,
staff_id ='',
tempname= ''
temp_id =''

def ids():
    '''
        This is a small funtions that picks id from random and sets it as the 
        id of the patients.
        The ids are deleted afterwards to prevent collision.

        A more secured way can be employed in generating the ids other than the hardcoded
        data
    '''
    p_ids=['P/001', 'P/002', 'P/003', 'P/004', 'P/005', 'P/006', 'P/007', 'P/008']
    i = random.randrange(len(p_ids))
    c_id = p_ids[i]
    del p_ids[i]
    return c_id

def now():
    '''
     A small function which returns the current date and time
    '''
    n = datetime.datetime.now()
    return n.strftime("%Y-%m- %d %H:%M")





@app.route('/')
def index():
    if not session.get('logged_in'):
        return render_template('getstarted/index.html')
    else:
        global name
        if name == 'D':
            return redirect(url_for('dr'))
        elif name == 'N':
            return redirect(url_for('nurse'))
        else:
            return render_template('error.html')   
        print('This is new name', name)
    
    # return "Hello Boss!  <a href='/logout'>Logout</a>"
    


@app.route('/login', methods=['POST'])
def login():
    uname = str(request.form['username'])
    password = str(request.form['password'])

    con = sql.connect('hms.db')
    c = con.cursor()
    c.execute("SELECT * from staff WHERE Uname= ? AND Password=?", (uname, password) )
    result =c.fetchall()



# the result returns a list which is empty if the query is not found else returns something if 
# a result if found
    if len(result) == 0:
        return render_template('error.html') 
    else:
        session['logged_in'] = True



        # the first variable gets the first of the character sequence entered and makes a route based on that
        global name, fullname, availble, staff_id
        first = result[0][3][:1]
        fullname = result[0][1]
        availble = result[0][5]
        staff_id = result[0][3]
        name = first
        print(name)
    return index()



@app.route('/register', methods=['GET', 'POST'])
def register():
    # try to handle empty forms in the html as script 
    con = sql.connect('hms.db')
    c = con.cursor()
    if request.method == 'POST':
        fname = str(request.form['fname'])
        lname = str(request.form['lname'])
        uname = str(request.form['uname'])
        password = str(request.form['pass'])
        c.execute("INSERT INTO staff (FName, LName, Uname, Password, Available) VALUES(?,?,?,?,?)", (fname,lname, uname,password,0,))
        con.commit()
        print('Data successfully added')
        return 'Data Successfully added'
       
    return render_template('getstarted/randl.html')



@app.route('/logout')
def logout():
    session['logged_in'] = False
    return index()




@app.route('/dr', methods=['GET', 'POST'])
def dr():
    con = sql.connect('hms.db')
    c = con.cursor()
    global fullname, availble, staff_id
    temp = str(staff_id)
    print(temp)
    time.sleep(1)
   
    # Fetches all those the nurses sent to me
    c.execute('SELECT * from patients_readings WHERE Sent_to= ?', (temp,))

    y = c.fetchall()

    print(y) 
    
    if request.method == 'POST':
        # con = sql.connect('hms.db')
        # c = con.cursor()
        d_available = request.form['available']

        if d_available == 'Yes':
            c.execute("UPDATE staff SET Available = ?  WHERE Uname= ?", (1, staff_id))
            con.commit()
            availble = 1
            return redirect(url_for('dr'))
        else:
            c.execute("UPDATE staff SET Available = ?  WHERE Uname= ?", (0, staff_id,))
            con.commit()
            availble = 0
            return redirect(url_for('dr'))
        print("Status from check", d_available)
    
    print("Status", availble)
    return render_template('dr/index.html', fullname=fullname, availble=availble, y=y)


@app.route('/nurse')
def nurse():
    return render_template('nurse/index.html')


@app.route('/patientdata', methods=['GET', 'POST'])
def patientdata():
    con = sql.connect('hms.db')
    c = con.cursor()

    if request.method == 'POST':
        p_id = ids()
        p_name = str(request.form['p_name'])
        p_dob = str(request.form['p_dob'])
        p_contact = str(request.form['p_contact'])
        timestamp = now()
        c.execute("INSERT INTO patients (Patients_ID, FullName, DOB, PhoneNumber, Last_Visit) VALUES(?,?,?,?,?)", (p_id, p_name, p_dob, p_contact,timestamp))
        con.commit()
        print('Data successfully added')
        return '''
        <a href="/readings">Take readings</a>
        '''
    return render_template('nurse/p_reg.html')


@app.route('/search', methods=['GET', 'POST'])
def search():
    con = sql.connect('hms.db')
    c = con.cursor()
    if request.method == 'POST':
        p_id = str(request.form['p_id'])
        c.execute("SELECT * from patients WHERE Patients_ID= ?", (p_id,) )
        result =c.fetchall()
        print(result)

        # fetches the name and id of the patient which will be used in
        #the readings route
        global tempname, temp_id
        tempname = result[0][2]
        temp_id = result[0][1]
        return render_template('nurse/s_results.html', result=result)
    return render_template('nurse/search.html')


@app.route('/readings', methods=['GET', 'POST'])
def read():
    con = sql.connect('hms.db')
    c = con.cursor()

    # fetch for the drs who are available
    c.execute("SELECT FName, UName from staff WHERE Available= 1")
    r = c.fetchall()
    
    print ("Available Drs. ",r)


    if request.method == 'POST':
        # p_n = str(request.form['p_n'])
        global tempname, temp_id

        p_n = tempname
        p_w = str(request.form['p_w'])
        p_t = str(request.form['p_t'])
        p_bp = str(request.form['p_bp'])
        nhis = str(request.form['nhis'])
        dr_available = str(request.form['availabledr'])
        timestamp = now()
        c.execute("INSERT INTO patients_readings (P_ID, Name, Weight, Temperature,BP, NHIS, Time_Taken, Sent_to) VALUES(?,?,?,?,?,?,?,?)", (temp_id,p_n, p_w, p_t, p_bp,nhis, timestamp, dr_available))
        con.commit()
        print("Data was sent to ", dr_available)
        print('Data successfully added')
        return '''
        <a href="/">Go home</a>
        '''
    return render_template('nurse/p_read.html', r=r)


@app.route('/diagnostics')
def diagnostics():
    # y = ids()
    # y = now()
    return render_template('dr/diagnostics.html')


if __name__ == '__main__':
    app.secret_key = os.urandom(12)
    app.run(debug=True)

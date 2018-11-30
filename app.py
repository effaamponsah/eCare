from flask import Flask, render_template, session, request, abort, redirect, flash
import sqlite3 as sql
import os

app = Flask(__name__)


fullname=''
name = ''
availble = False

@app.route('/')
def index():

    if not session.get('logged_in'):
        return render_template('getstarted/index.html')
    else:
        # global name
        if name == 'D':
            return render_template('dr/index.html')
        elif name == 'N':
            return render_template('nurses/index.html')
        else:
            return render_template('error.html')   
        print('This is new name', name)
    
    return "Hello Boss!  <a href='/logout'>Logout</a>"
    


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
        first = result[0][3][:1]
        global name
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
        return 'Data Success'
       
    return render_template('getstarted/randl.html')



@app.route('/logout')
def logout():
    session['logged_in'] = False
    return index()

@app.route('/temp')
def temp():
    return render_template('dr/index.html')

if __name__ == '__main__':
    app.secret_key = os.urandom(12)
    app.run(debug=True, port=6000)

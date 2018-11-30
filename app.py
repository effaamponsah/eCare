from flask import Flask, render_template, session, request, abort, redirect, flash
import sqlite3 as sql
import os


app = Flask(__name__)

@app.route('/')
def index():
    if not session.get('logged_in'):
        return render_template('getstarted/index.html')
    else:
        return "Hello Boss!  <a href='/logout'>Logout</a>"


@app.route('/login', methods=['POST'])
def login():
    if request.form['password'] == 'password' and request.form['username'] == 'admin':
        session['logged_in'] = True
    else:
        print('Wrong user name and ir')
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
        c.execute("INSERT INTO staff (FName, LName, Uname, Password, Available) VALUES(?,?,?,0)", (fname,lname, uname,password,))
        con.commit()
       
    return render_template('getstarted/randl.html')



@app.route('/logout')
def logout():
    session['logged_in'] = False
    return index()



if __name__ == '__main__':
    app.secret_key = os.urandom(12)
    app.run(debug=True, port=6000)

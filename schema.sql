drop table if exists staff;

CREATE TABLE staff (
    id integer primary key autoincrement, 
    FName text not null,
    LName text not null, 
    Password text not null,
    Available boolean )

INSERT INTO staff VALUES(
    ?,?,?,?,0
    )
    , 
    ('Dennis','Effa', 'asdnakd',)

CREATE TABLE patients (
    id integer primary key autoincrement, 
    FullName text not null,
    DOB date not null, 
    PhoneNumber bigint,
    Last_Visit text
    )


INSERT INTO patients (
    Patients_ID,
    FullName,
    DOB, PhoneNumber, 
    Last_Visit) 
    VALUES(?,?,?,?,?), 
    (p_id, p_name, p_dob, p_contact,timestamp)
    )

CREATE TABLE patients_readings (
    id integer primary key not null,
    P_ID text not null,Name text not null,
    Weight integer not null,
    Temperature integer not null,
    BP integer not null,
    NHIS char,
    Time_Taken text)


UPDATE staff SET Available = ? 
 WHERE Uname= ?, (1, staff_id,)


CREATE TABLE patients_readings (
    id integer primary key not null,
    P_ID text not null,Name text not null,
    Weight integer not null,
    Temperature integer not null,
    BP integer not null,
    NHIS char,
    Time_Taken text)


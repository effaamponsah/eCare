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

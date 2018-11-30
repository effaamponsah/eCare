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
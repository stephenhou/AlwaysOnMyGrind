drop table gymBro_does_exercises;
drop table involves;
drop table bodyPart_for;
drop table bodyPart;
drop table pt_does_dayOfWorkout;
drop table g_does_dayOfWorkout;
drop table dayOfWorkoutDate;
drop table workout_has;
drop table dayOfWorkout;
drop table workout;
drop table exercises;
drop table trains;
drop table personalTrainer;
drop table gymBro;
drop table equipment;

create table personalTrainer
	( pid integer PRIMARY KEY,
	fullname varchar2(50),	
    username varchar2(50),
    password varchar2(50),
	gender char(1),
	age integer,
	phone integer,
	email varchar2(50),
	weight number(*,1) );

create table gymBro
	( gid integer PRIMARY KEY,
	fullname varchar2(50),	
	username varchar2(50),
	password varchar2(50),
	gender char(1),
	age integer,
	phone integer,
	email varchar2(50),
	weight number(*,1) );

create table trains
	( apptDate date,
	apptTime char(5),
	review varchar2(200),
	rating integer,
	goal varchar2(200),
	pid integer,
	gid integer,
	PRIMARY KEY (apptDate, apptTime, pid, gid),
	foreign key (gid) references gymBro,
	foreign key (pid) references personalTrainer );

create table workout
	( workoutId integer PRIMARY KEY );

create table bodyPart
	( type varchar2(40) PRIMARY KEY );

create table exercises
	( name varchar2(40) PRIMARY KEY );

create table workout_has
	( workoutId integer,
	name varchar2(40),
	PRIMARY KEY (workoutId, name),
	foreign key (workoutId) references workout,
	foreign key (name) references exercises );

create table bodyPart_for
	( type varchar2(40),
	workoutId integer,
	PRIMARY KEY (type, workoutId),
	foreign key (type) references bodyPart,
	foreign key (workoutId) references workout );

create table dayOfWorkout
	( nameOfDay char(3),
	workoutId integer,
	specificWorkoutId integer,
	PRIMARY KEY (workoutId, specificWorkoutId),
	foreign key (workoutId) references workout );

create table pt_does_dayOfWorkout
	( workoutId integer,
	specificWorkoutId integer,
	pid integer,
	dateOfEntry date,
	PRIMARY KEY ( workoutId, specificWorkoutId, dateOfEntry),
	foreign key (pid) references personalTrainer,
	foreign key (workoutId, specificWorkoutId) references dayOfWorkout );


create table g_does_dayOfWorkout
	( workoutId integer,
	specificWorkoutId integer,
	gid integer,
	dateOfEntry date,
	PRIMARY KEY ( workoutId, specificWorkoutId, dateOfEntry),
	foreign key (gid) references gymBro,
	foreign key (workoutId, specificWorkoutId) references dayOfWorkout );

create table dayOfWorkoutDate
	( dateOfEntry date PRIMARY KEY,
	nameOfDay char(3) );


create table gymBro_does_exercises
	( gid integer,
	name varchar2(40),
	recordedDate date,
	sets integer,
	reps integer,
	weight integer,
	PRIMARY KEY (gid, name, recordedDate),
	foreign key (gid) references gymBro,
	foreign key (name) references exercises );

create table equipment
	(name varchar2(40) PRIMARY KEY );

create table involves
	( equipName varchar2(40),
	exName varchar2(40),
	PRIMARY KEY (equipName, exName),
	foreign key (equipName) references equipment,
	foreign key (exName) references exercises );

insert into personalTrainer values
	( 10000000, 'Arnold Schwarzenegger', 'arnold99', 'absdf', 'M', 39, 6045798123, 'arnoldschwarzenegger@gmail.com', 250.6);
insert into personalTrainer values
	( 10000001, 'Lou Ferrigno', 'lou99', 'babaf', 'M', 39, 6045798123, 'LouFerrigno@gmail.com', 253.3);
insert into personalTrainer values
	( 10000002, 'Iris Kyle', 'iris99', 'aqqer', 'F', 39, 6045798123, 'IrisKyle@gmail.com', 160.2);
insert into personalTrainer values
	( 10000003, 'Ronnie Coleman', 'ronnie99', 'qetqgq', 'M', 39, 6045798123, 'RonnieColeman@gmail.com', 260.3);
insert into personalTrainer values
	( 10000004, 'Jay Cutler', 'jay99', 'badfadg', 'M', 39, 6045798123, 'JayCutler@gmail.com', 249.9);

insert into gymBro values
	( 20000000, 'Stephen Hou', 'shou', 'go', 'M', 19, 6045798123, 'stephenhou@gmail.com', 165.0);
insert into gymBro values
	( 20000001, 'Andrew Oh', 'andrew_oh', 'bzcfqre', 'M', 19, 6045798123, 'andrewoh@gmail.com', 180.0);
insert into gymBro values
	( 20000002, 'Liu Fangzhong', 'liu_fangzhong', 'abaoerwe', 'M', 19, 6045798123, 'liufangzhong@gmail.com', 165.3);
insert into gymBro values
	( 20000003, 'Kanye West', 'kanye_west', 'adfbbadf', 'M', 40, 6045798123, 'yeezy@gmail.com', 160.8);
insert into gymBro values
	( 20000004, 'Kevin Hart', 'kevin_hart', 'adflbaabdf', 'M', 36, 6045798123, 'kevhart@gmail.com', 92.3);

insert into trains values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), '14:30', 'good', 5, 'bench 500 or dont come back', 10000000, 20000000);
insert into trains values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), '15:30', 'good', 5, 'bench 500 or dont come back', 10000000, 20000001);
insert into trains values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), '16:30', 'good', 5, 'bench 500 or dont come back', 10000000, 20000002);
insert into trains values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), '17:30', 'good', 5, 'bench 500 or dont come back', 10000000, 20000003);
insert into trains values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), '18:30', 'good', 5, 'bench 500 or dont come back', 10000000, 20000004);

insert into workout values (30000000);
insert into workout values (30000001);
insert into workout values (30000002);
insert into workout values (30000003);
insert into workout values (30000004);

insert into bodyPart values ('chest');
insert into bodyPart values ('arms');
insert into bodyPart values ('back');
insert into bodyPart values ('legs');

insert into bodyPart_for values ('chest', 30000000);
insert into bodyPart_for values ('arms', 30000001);
insert into bodyPart_for values ('back', 30000002);
insert into bodyPart_for values ('legs', 30000003);
insert into bodyPart_for values ('chest', 30000004);
insert into bodyPart_for values ('arms', 30000004);
insert into bodyPart_for values ('back', 30000004);
insert into bodyPart_for values ('legs', 30000004);

insert into exercises values ('Dumbbell press');
insert into exercises values ('Incline Dumbbell press');
insert into exercises values ('Decline Dumbbell press');
insert into exercises values ('Incline Bench press');
insert into exercises values ('Decline Bench press');
insert into exercises values ('Cable cross');
insert into exercises values ('Dumbbell curls');
insert into exercises values ('Barbell curls');
insert into exercises values ('Cable curls');
insert into exercises values ('Rope push-downs');
insert into exercises values ('Deadlifts');
insert into exercises values ('Chin-ups');
insert into exercises values ('Cable Pull-downs');
insert into exercises values ('Back machine');
insert into exercises values ('Lunges');
insert into exercises values ('Squats');
insert into exercises values ('Leg Press');
insert into exercises values ('Treadmill');
insert into exercises values ('Bike');
insert into exercises values ('Swimming');

insert into workout_has values (30000000, 'Dumbbell press');
insert into workout_has values (30000000, 'Incline Dumbbell press');
insert into workout_has values (30000000, 'Decline Dumbbell press');
insert into workout_has values (30000000, 'Incline Bench press');
insert into workout_has values (30000000, 'Decline Bench press');
insert into workout_has values (30000000, 'Cable cross');
insert into workout_has values (30000001, 'Dumbbell curls');
insert into workout_has values (30000001, 'Barbell curls');
insert into workout_has values (30000001, 'Cable curls');
insert into workout_has values (30000001, 'Rope push-downs');
insert into workout_has values (30000002, 'Deadlifts');
insert into workout_has values (30000002, 'Chin-ups');
insert into workout_has values (30000002, 'Cable Pull-downs');
insert into workout_has values (30000002, 'Back machine');

insert into workout_has values (30000003, 'Lunges');
insert into workout_has values (30000003, 'Squats');
insert into workout_has values (30000003, 'Leg Press');
insert into workout_has values (30000004, 'Treadmill');
insert into workout_has values (30000004, 'Bike');
insert into workout_has values (30000004, 'Swimming');

insert into gymBro_does_exercises  values (20000004, 'Dumbbell press', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 180);
insert into gymBro_does_exercises  values (20000004, 'Dumbbell press', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 150);
insert into gymBro_does_exercises  values (20000004, 'Incline Dumbbell press', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 240);
insert into gymBro_does_exercises  values (20000004, 'Incline Dumbbell press', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 230);
insert into gymBro_does_exercises  values (20000004, 'Decline Dumbbell press', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 190);
insert into gymBro_does_exercises  values (20000004, 'Decline Dumbbell press', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 200);
insert into gymBro_does_exercises  values (20000004, 'Incline Bench press', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 320);
insert into gymBro_does_exercises  values (20000004, 'Incline Bench press', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 300);
insert into gymBro_does_exercises  values (20000004, 'Decline Bench press', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 150);
insert into gymBro_does_exercises  values (20000004, 'Decline Bench press', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 130);
insert into gymBro_does_exercises  values (20000004, 'Cable cross', TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 305);
insert into gymBro_does_exercises  values (20000004, 'Cable cross', TO_DATE('19-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 335);
insert into gymBro_does_exercises  values (20000004, 'Dumbbell curls', TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 330);
insert into gymBro_does_exercises  values (20000004, 'Dumbbell curls', TO_DATE('20-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 315);
insert into gymBro_does_exercises  values (20000004, 'Barbell curls', TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 190);
insert into gymBro_does_exercises  values (20000004, 'Barbell curls', TO_DATE('20-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 225);
insert into gymBro_does_exercises  values (20000004, 'Cable curls', TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 245);
insert into gymBro_does_exercises  values (20000004, 'Cable curls', TO_DATE('20-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 235);
insert into gymBro_does_exercises  values (20000004, 'Rope push-downs', TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 180);
insert into gymBro_does_exercises  values (20000004, 'Rope push-downs', TO_DATE('20-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 190);
insert into gymBro_does_exercises  values (20000004, 'Deadlifts', TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 120);
insert into gymBro_does_exercises  values (20000004, 'Deadlifts', TO_DATE('21-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 140);
insert into gymBro_does_exercises  values (20000004, 'Chin-ups', TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 130);
insert into gymBro_does_exercises  values (20000004, 'Chin-ups', TO_DATE('21-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 150);
insert into gymBro_does_exercises  values (20000004, 'Cable Pull-downs', TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 150);
insert into gymBro_does_exercises  values (20000004, 'Cable Pull-downs', TO_DATE('21-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 160);
insert into gymBro_does_exercises  values (20000004, 'Back machine', TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 175);
insert into gymBro_does_exercises  values (20000004, 'Back machine', TO_DATE('21-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 185);
insert into gymBro_does_exercises  values (20000004, 'Lunges', TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 200);
insert into gymBro_does_exercises  values (20000004, 'Lunges', TO_DATE('22-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 195);
insert into gymBro_does_exercises  values (20000004, 'Squats', TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 400);
insert into gymBro_does_exercises  values (20000004, 'Squats', TO_DATE('22-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 390);
insert into gymBro_does_exercises  values (20000004, 'Leg Press', TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 300);
insert into gymBro_does_exercises  values (20000004, 'Leg Press', TO_DATE('22-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 225);
insert into gymBro_does_exercises  values (20000004, 'Treadmill', TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 210);
insert into gymBro_does_exercises  values (20000004, 'Treadmill', TO_DATE('23-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 220);
insert into gymBro_does_exercises  values (20000004, 'Bike', TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 100);
insert into gymBro_does_exercises  values (20000004, 'Bike', TO_DATE('23-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 105);
insert into gymBro_does_exercises  values (20000004, 'Swimming', TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 135);
insert into gymBro_does_exercises  values (20000004, 'Swimming', TO_DATE('23-JUNE-2016', 'DD-MM-YYYY'), 3, 6, 150);

insert into equipment values ('bench');
insert into equipment values ('squat rack');
insert into equipment values ('all mighty machine');
insert into equipment values ('dumbbells');
insert into equipment values ('barbell');
insert into equipment values ('treadmill');
insert into equipment values ('bike');
insert into equipment values ('water');

insert into involves values ('bench', 'Incline Dumbbell press');
insert into involves values ('bench', 'Decline Dumbbell press');
insert into involves values ('bench', 'Incline Bench press');
insert into involves values ('bench', 'Decline Bench press');
insert into involves values ('all mighty machine', 'Cable cross');
insert into involves values ('bench', 'Dumbbell press');
insert into involves values ('dumbbells', 'Dumbbell press');
insert into involves values ('dumbbells', 'Dumbbell curls');
insert into involves values ('barbell', 'Barbell curls');
insert into involves values ('all mighty machine', 'Cable curls');
insert into involves values ('all mighty machine', 'Rope push-downs');
insert into involves values ('barbell', 'Deadlifts');
insert into involves values ('all mighty machine', 'Chin-ups');
insert into involves values ('all mighty machine', 'Cable Pull-downs');
insert into involves values ('all mighty machine', 'Back machine');
insert into involves values ('barbell', 'Squats');
insert into involves values ('squat rack', 'Squats');
insert into involves values ('all mighty machine', 'Leg Press');
insert into involves values ('treadmill', 'Treadmill');
insert into involves values ('bike', 'Bike');
insert into involves values ('water', 'Swimming');

insert into dayOfWorkout values
( 'SUN', 30000000, 40000000);
insert into dayOfWorkout values
( 'MON', 30000001, 40000001);
insert into dayOfWorkout values
( 'TUE', 30000002, 40000002);
insert into dayOfWorkout values
( 'WED', 30000003, 40000003);
insert into dayOfWorkout values
( 'THU', 30000004, 40000004);
insert into dayOfWorkout values
( 'SUN', 30000000, 50000000);
insert into dayOfWorkout values
( 'MON', 30000001, 50000001);
insert into dayOfWorkout values
( 'TUE', 30000002, 50000002);
insert into dayOfWorkout values
( 'WED', 30000003, 50000003);
insert into dayOfWorkout values
( 'THU', 30000004, 50000004);

insert into pt_does_dayOfWorkout values
( 30000000, 40000000, 10000000, TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
( 30000001, 40000001, 10000001, TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
( 30000002, 40000002, 10000002, TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
( 30000003, 40000003, 10000003, TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
( 30000004, 40000004, 10000004, TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'));

insert into g_does_dayOfWorkout values
( 30000000, 50000000, 20000004, TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
( 30000001, 50000001, 20000004, TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
( 30000002, 50000002, 20000004, TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
( 30000003, 50000003, 20000004, TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
( 30000004, 50000004, 20000004, TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'));

insert into dayOfWorkoutDate values
( TO_DATE('12-JUNE-2016', 'DD-MM-YYYY'), 'SUN');
insert into dayOfWorkoutDate values
( TO_DATE('13-JUNE-2016', 'DD-MM-YYYY'), 'MON');
insert into dayOfWorkoutDate values
( TO_DATE('14-JUNE-2016', 'DD-MM-YYYY'), 'TUE');
insert into dayOfWorkoutDate values
( TO_DATE('15-JUNE-2016', 'DD-MM-YYYY'), 'WED');
insert into dayOfWorkoutDate values
( TO_DATE('16-JUNE-2016', 'DD-MM-YYYY'), 'THU');
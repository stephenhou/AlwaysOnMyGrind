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
	name varchar2(50),
	gender char(1),
	age integer,
	phone integer,
	email varchar2(50),
	weight number(*,1) );

create table gymBro
	( gid integer PRIMARY KEY,
	username varchar2(50),
	password varchar2(50),
	fullname varchar2(50),
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
	pRecord integer,
	recordedDate date,
	sets integer,
	reps integer,
	weight integer,
	PRIMARY KEY (gid, name),
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
	( 10000000, 'Arnold Schwarzenegger', 'M', 39, 6045798123, 'arnoldschwarzenegger@gmail.com', 250.6);
insert into personalTrainer values
	( 10000001, 'Lou Ferrigno', 'M', 39, 6045798123, 'LouFerrigno@gmail.com', 253.3);
insert into personalTrainer values
	( 10000002, 'Iris Kyle', 'F', 39, 6045798123, 'IrisKyle@gmail.com', 160.2);
insert into personalTrainer values
	( 10000003, 'Ronnie Coleman', 'M', 39, 6045798123, 'RonnieColeman@gmail.com', 260.3);
insert into personalTrainer values
	( 10000004, 'Jay Cutler', 'M', 39, 6045798123, 'JayCutler@gmail.com', 249.9);

insert into gymBro values
	( 20000000, 'Stephen Hou', 'stephen_hou', 'abcdefg', 'M', 19, 6045798123, 'stephenhou@gmail.com', 165.0);
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

insert into workout values
	( 30000000);
insert into workout values
	( 30000001);
insert into workout values
	( 30000002);
insert into workout values
	( 30000003);
insert into workout values
	( 30000004);

insert into bodyPart values
	( 'pectorals');
insert into bodyPart values
	( 'quadriceps');
insert into bodyPart values
	( 'biceps');
insert into bodyPart values
	( 'triceps');
insert into bodyPart values
	( 'deltoids');

insert into bodyPart_for values
	( 'pectorals', 30000000);
insert into bodyPart_for values
	( 'quadriceps', 30000001);
insert into bodyPart_for values
	( 'biceps', 30000002);
insert into bodyPart_for values
	( 'triceps', 30000003);
insert into bodyPart_for values
	( 'deltoids', 30000004);

insert into exercises values
	( 'bench press');
insert into exercises values
	( 'squats');
insert into exercises values
	( 'arm curls');
insert into exercises values
	( 'close-grip benchpress');
insert into exercises values
	( 'military press');

insert into workout_has values
	( 30000000, 'bench press');
insert into workout_has values
	( 30000001,'squats');
insert into workout_has values
	( 30000002, 'arm curls');
insert into workout_has values
	( 30000003, 'close-grip benchpress');
insert into workout_has values
	( 30000004, 'military press');

insert into gymBro_does_exercises values
	( 20000000, 'squats', 300, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 5, 5, 250);
insert into gymBro_does_exercises values
	( 20000001, 'squats', 300, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 5, 5, 250);
insert into gymBro_does_exercises values
	( 20000002, 'squats', 300, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 5, 5, 250);
insert into gymBro_does_exercises values
	( 20000003, 'squats', 300, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 5, 5, 250);
insert into gymBro_does_exercises values
	( 20000004, 'squats', 300, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 5, 5, 250);

insert into equipment values
	( 'bench');
insert into equipment values
	( 'squat rack');
insert into equipment values
	( 'barbell');
insert into equipment values
	( '30 lb dumbbells');
insert into equipment values
	( 'pullup bar');

insert into involves values
	( 'bench', 'bench press');
insert into involves values
	( 'squat rack', 'squats');
insert into involves values
	( '30 lb dumbbells', 'arm curls');
insert into involves values
	( 'barbell', 'close-grip benchpress');
insert into involves values
	( 'barbell', 'military press');

insert into dayOfWorkout values
	( 'MON', 30000000, 40000000);
insert into dayOfWorkout values
	( 'TUE', 30000000, 40000001);
insert into dayOfWorkout values
	( 'WED', 30000000, 40000002);
insert into dayOfWorkout values
	( 'THU', 30000000, 40000003);
insert into dayOfWorkout values
	( 'FRI', 30000000, 40000004);
insert into dayOfWorkout values
	( 'MON', 30000000, 50000000);
insert into dayOfWorkout values
	( 'TUE', 30000000, 50000001);
insert into dayOfWorkout values
	( 'WED', 30000000, 50000002);
insert into dayOfWorkout values
	( 'THU', 30000000, 50000003);
insert into dayOfWorkout values
	( 'FRI', 30000000, 50000004);


insert into pt_does_dayOfWorkout values
	( 30000000, 40000000, 10000000, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
	( 30000000, 40000001, 10000001, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
	( 30000000, 40000002, 10000002, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
	( 30000000, 40000003, 10000003, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into pt_does_dayOfWorkout values
	( 30000000, 40000004, 10000004, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));


insert into g_does_dayOfWorkout values
	( 30000000, 50000000, 20000000, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
	( 30000000, 50000001, 20000001, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
	( 30000000, 50000002, 20000002, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
	( 30000000, 50000003, 20000003, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));
insert into g_does_dayOfWorkout values
	( 30000000, 50000004, 20000004, TO_DATE('31-MAY-2016', 'DD-MM-YYYY'));

insert into dayOfWorkoutDate values
	( TO_DATE('31-MAY-2016', 'DD-MM-YYYY'), 'TUE');
insert into dayOfWorkoutDate values
	( TO_DATE('01-JUNE-2016', 'DD-MM-YYYY'), 'WED');
insert into dayOfWorkoutDate values
	( TO_DATE('02-JUNE-2016', 'DD-MM-YYYY'), 'THU');
insert into dayOfWorkoutDate values
	( TO_DATE('03-JUNE-2016', 'DD-MM-YYYY'), 'FRI');
insert into dayOfWorkoutDate values
	( TO_DATE('04-JUNE-2016', 'DD-MM-YYYY'), 'SAT');
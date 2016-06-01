drop table gymBro_does_exercises;
drop table involves;
drop table exercises_has;
drop table bodyPart_for;
drop table bodyPart;
drop table workout;
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
	name varchar2(50),
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

create table bodyPart_for
	( type varchar2(40),
	workoutId integer,
	PRIMARY KEY (type, workoutId),
	foreign key (type) references bodyPart,
	foreign key (workoutId) references workout );

create table exercises_has
	( name varchar2(40) PRIMARY KEY,
	workoutId integer,
	foreign key (workoutId) references workout );

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
	foreign key (name) references exercises_has );

create table equipment
	(name varchar2(40) PRIMARY KEY );

create table involves
	( equipName varchar2(40),
	exName varchar2(40),
	PRIMARY KEY (equipName, exName),
	foreign key (equipName) references equipment,
	foreign key (exName) references exercises_has );

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
	( 20000000, 'Stephen Hou', 'M', 19, 6045798123, 'stephenhou@gmail.com', 165.0);
insert into gymBro values
	( 20000001, 'Andrew Oh', 'M', 19, 6045798123, 'andrewoh@gmail.com', 180.0);
insert into gymBro values
	( 20000002, 'Liu Fangzhong', 'M', 19, 6045798123, 'liufangzhong@gmail.com', 165.3);
insert into gymBro values
	( 20000003, 'Kanye West', 'M', 40, 6045798123, 'yeezy@gmail.com', 160.8);
insert into gymBro values
	( 20000004, 'Kevin Hart', 'M', 36, 6045798123, 'kevhart@gmail.com', 92.3);

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

insert into exercises_has values
	( 'bench press', 30000000);
insert into exercises_has values
	( 'squats', 30000001);
insert into exercises_has values
	( 'arm curls', 30000002);
insert into exercises_has values
	( 'close-grip benchpress', 30000003);
insert into exercises_has values
	( 'military press', 30000004);

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

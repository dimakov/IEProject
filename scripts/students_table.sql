CREATE TABLE students(
	ID INT NOT NULL,
	ApplicDate DATE,
	Country VARCHAR(40),
	City VARCHAR(40),
	District VARCHAR(40),
	School VARCHAR(40),
	GradeAR INT NOT NULL,
	Age INT NOT NULL,
	UniGrade INT NOT NULL,
	Success BOOLEAN,
	Applicant BOOLEAN,
	Student BOOLEAN,
	GradStud BOOLEAN,
	PRIMARY KEY (ID)
);
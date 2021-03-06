CREATE TABLE students(
	ID INT NOT NULL,
	Acceptance_Date DATE,
	Faculty VARCHAR(40),
	Homeland VARCHAR(40),
	Current_Country VARCHAR(40),
	City VARCHAR(40),
	County VARCHAR(40),
	Highschool VARCHAR(40),
	Year_Of_Birth INT,
	Internal_Bagrut INT,
	math_score_11 INT,
	math_score_12 INT,
	physics_score_11 INT,
	physics_score_12 INT,
	learning_dis BOOLEAN,
	english_test BOOLEAN,
	english_grade INT,
	english_test_type VARCHAR(100),
	sorting_test BOOLEAN,
	s_t_math_grade INT,
	s_t_physics_grade INT,
	s_t_final INT,
	s_t_type VARCHAR(40),
	university BOOLEAN,
	interview_grade INT,
	scholarship BOOLEAN,
	accepted BOOLEAN,
	Pass_mechina BOOLEAN,
	comments VARCHAR(120),
	prediction_res FLOAT,
	checked BOOLEAN,
	PRIMARY KEY (ID)
);
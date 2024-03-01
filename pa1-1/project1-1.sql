CREATE TABLE Motion_Picture (
	mid CHAR(20),
	name TEXT,
	release_date DATE,
	production TEXT,
	budget FLOAT,
	ratings FLOAT,
	genre_id CHAR(20),
	PRIMARY KEY(mid),
	FOREIGN KEY (genre_id) REFERENCES Genre(genre_id)
);

CREATE TABLE Movie (
	mid CHAR(20),
	box_office_collection INTEGER,
	FOREIGN KEY (mid) REFERENCES Motion_Picture(mid),
	PRIMARY KEY (mid, box_office_collection)
);

CREATE TABLE TV_Series (
	mid CHAR(20),
	number_of_seasons INTEGER,
	FOREIGN KEY (mid) REFERENCES Motion_Picture(mid) PRIMARY KEY (mid, number_of_seasons)
);

CREATE TABLE Genre (
	genre_id CHAR(20),
	genre_description TEXT,
	PRIMARY KEY(genre_id)
);

CREATE TABLE People (
	pid CHAR(20),
	name TEXT,
	nationality TEXT,
	DoB DATE,
	gender TEXT,
	PRIMARY KEY (pid)
);

CREATE TABLE Registered_User (
	uid CHAR(20),
	name TEXT,
	email TEXT,
	age INTEGER,
	PRIMARY KEY (uid)
);

- “ Location ” is a weak entity CREATE TABLE Location (
	mid CHAR(20),
	name TEXT,
	country TEXT,
	city TEXT,
	FOREIGN KEY (mid) REFERENCES Motion_Picture(mid) PRIMARY KEY (mid, name)
);

- “ Awards ” is a weak entity CREATE TABLE Awards (
	award_name TEXT,
	year_recieved INTEGER,
	pid CHAR(20),
	mid CHAR(20),
	FOREIGN KEY (pid) REFERENCES People(pid),
	FOREIGN KEY (mid) REFERENCES Motion_Picture(mid) PRIMARY KEY(pid, award_name, year_recieved)
);

- "Likes" is a many - to - many relationship between Registered_User
and Motion_Picture CREATE TABLE Likes (
	uid CHAR(20),
	mid CHAR(20),
	FOREIGN KEY (uid) REFERENCES Registered_User(uid),
	FOREIGN KEY (mid) REFERENCES Motion_Picture(MID),
	PRIMARY KEY (uid, mid)
);

- "Roles" is a many - to - many relationship between People
and Motion_Picture CREATE TABLE Roles (
	pid CHAR(20),
	mid CHAR(20),
	role_description TEXT,
	FOREIGN KEY (pid) REFERENCES People(pid),
	FOREIGN KEY (mid) REFERENCES Motion_Picture(mid),
	PRIMARY KEY (pid, mid, role_description)
);
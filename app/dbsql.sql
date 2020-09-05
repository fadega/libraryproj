CREATE TABLE IF NOT EXISTS user(
      user_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      firstname TEXT NOT NULL,
      lastname TEXT NOT NULL,
      email TEXT NOT NULL UNIQUE,
      password TEXT NOT NULL,
      level TEXT,
      regDate DATE
    );

CREATE TABLE IF NOT EXISTS author(
			author_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			firstname TEXT NOT NULL,
			lastname TEXT NOT NULL,
      email TEXT NOT NULL UNIQUE
		);

CREATE TABLE IF NOT EXISTS publisher(
			publisher_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			pname TEXT NOT NULL,
			city TEXT,
			country TEXT NOT NULL
		);



CREATE TABLE IF NOT EXISTS category(
      category_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      cname TEXT  NOT NULL
    );

CREATE TABLE IF NOT EXISTS genre(
      genre_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      gname TEXT  NOT NULL,
      category_id INTEGER NOT NULL REFERENCES category(category_id) ON UPDATE CASCADE ON DELETE CASCADE

    );

CREATE TABLE IF NOT EXISTS book (
      book_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      title TEXT NOT NULL,
      author_id INTEGER NOT NULL REFERENCES author(author_id) ON UPDATE CASCADE,
      ISBN TEXT NOT NULL,
      publisher_id INTEGER NOT NULL REFERENCES publisher(publisher_id),
      category_id INTEGET NOT NULL REFERENCES category(category_id),
			genre_id INTEGET NOT NULL REFERENCES genre(genre_id),
      year INTEGER NOT NULL,
      cover BLOB,
      price REAL,
      condition TEXT NOT NULL
    );

CREATE TABLE IF NOT EXISTS cart (
      cart_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      user_id INTEGER NOT NULL REFERENCES user(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
      book_id INTEGER NOT NULL REFERENCES book(book_id) ON UPDATE CASCADE ON DELETE CASCADE,
      quantity INTEGER,
      dateOrdered DATE

    );

CREATE TABLE IF NOT EXISTS comment (
      comment_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      comment TEXT NOT NULL,
      user_id INTEGER NOT NULL REFERENCES user(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
      book_id INTEGER NOT NULL REFERENCES book(book_id) ON UPDATE CASCADE ON DELETE CASCADE,
      dateWritten DATE

    );

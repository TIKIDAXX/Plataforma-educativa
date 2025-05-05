 4. SQL with Examples

SQL (Structured Query Language) is used to manage relational databases.

### Basic SQL Commands

**CREATE TABLE:**
```sql
CREATE TABLE Students (
    StudentID INT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE,
    EnrollmentDate DATE DEFAULT CURRENT_DATE
);
INSERT:


INSERT INTO Students (StudentID, Name, Email)
VALUES (1, 'John Doe', 'john@example.com');
SELECT:


SELECT * FROM Students;
SELECT Name, Email FROM Students WHERE StudentID = 1;
UPDATE:


UPDATE Students SET Email = 'john.doe@example.com' WHERE StudentID = 1;
DELETE:


DELETE FROM Students WHERE StudentID = 1;
```
**Exercise 4.1**: Write SQL to create tables for the library system from Exercise 2.1 and insert sample data.

<details>
<summary>Solution</summary>

```
CREATE TABLE Book (
    ISBN VARCHAR(20) PRIMARY KEY,
    Title VARCHAR(100) NOT NULL,
    Author VARCHAR(50),
    Year INT
);

CREATE TABLE Member (
    MemberID INT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Email VARCHAR(100),
    JoinDate DATE
);

CREATE TABLE Loan (
    LoanID INT PRIMARY KEY,
    MemberID INT REFERENCES Member(MemberID),
    ISBN VARCHAR(20) REFERENCES Book(ISBN),
    LoanDate DATE NOT NULL,
    DueDate DATE NOT NULL,
    ReturnDate DATE
);

INSERT INTO Book VALUES ('123-456', 'Database Design', 'A. Smith', 2020);
INSERT INTO Member VALUES (1, 'Maria Garcia', 'maria@email.com', '2023-01-15');
INSERT INTO Loan VALUES (1, 1, '123-456', '2023-05-10', '2023-06-10', NULL);
```
</details> 

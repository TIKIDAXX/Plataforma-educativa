## 2. Relationships and Entities

### Entities
An entity is a distinguishable object about which data is stored (e.g., Customer, Product, Order).

### Attributes
Properties that describe an entity (e.g., CustomerID, Name, Email for Customer entity).

### Relationships
Associations between entities:
- One-to-One (1:1)
- One-to-Many (1:M)
- Many-to-Many (M:N)

**Example:**
Entities:

Student (StudentID, Name, Email)

Course (CourseID, Title, Credits)

Relationship:

Enrollment (StudentID, CourseID, Grade) - resolves M:N relationship


**Exercise 2.1:** Design entities and relationships for a library system with Books, Members, and Loans.
<details>
<summary>Solution</summary>

Entities:
- Book (ISBN, Title, Author, Year)
- Member (MemberID, Name, Email, JoinDate)
- Loan (LoanID, MemberID, ISBN, LoanDate, DueDate, ReturnDate)

Relationships:
- A Member can borrow many Books (1:M)
- A Book can be borrowed by many Members over time (M:N resolved through Loan entity)
</details>

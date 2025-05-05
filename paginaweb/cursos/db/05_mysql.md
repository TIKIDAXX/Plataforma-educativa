## 5. MySQL Differences from Standard SQL

MySQL is an open-source relational database management system with some differences from standard SQL.

**Key Differences:**

1. **Auto-increment:**
```sql
-- MySQL
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50)
);

-- Standard SQL
CREATE TABLE Users (
    UserID INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    Username VARCHAR(50)
);
String Comparison:

MySQL is case-insensitive by default

Standard SQL is case-sensitive

LIMIT vs FETCH:


-- MySQL
SELECT * FROM Products LIMIT 10 OFFSET 5;

-- Standard SQL
SELECT * FROM Products OFFSET 5 ROWS FETCH NEXT 10 ROWS ONLY;
Date Functions:


-- MySQL
SELECT NOW(), CURDATE();

-- Standard SQL
SELECT CURRENT_TIMESTAMP, CURRENT_DATE;
```
Exercise 5.1: Convert this standard SQL to MySQL:

```sql
SELECT ProductName, UnitPrice 
FROM Products 
WHERE UnitPrice > 100 
ORDER BY ProductName 
OFFSET 10 ROWS FETCH NEXT 5 ROWS ONLY;
```
<details> 
<summary>Solution</summary>

```sql
SELECT ProductName, UnitPrice 
FROM Products 
WHERE UnitPrice > 100 
ORDER BY ProductName 
LIMIT 5 OFFSET 10;
```
</details> 

## 3. Normalization (1NF, 2NF, 3NF)

Normalization is the process of organizing data to minimize redundancy.

### First Normal Form (1NF)
- Each table cell should contain a single value
- Each record needs to be unique

**Example (Not 1NF):**
Order (OrderID, CustomerID, Products)

**1NF Solution:**
Order (OrderID, CustomerID)
OrderItem (OrderItemID, OrderID, ProductID, Quantity)


### Second Normal Form (2NF)
- Must be in 1NF
- All non-key attributes depend on the entire primary key

**Example (Not 2NF):**
OrderItem (OrderItemID, OrderID, ProductID, ProductName, Quantity)

**2NF Solution:**
OrderItem (OrderItemID, OrderID, ProductID, Quantity)
Product (ProductID, ProductName)


### Third Normal Form (3NF)
- Must be in 2NF
- No transitive dependencies (non-key attributes shouldn't depend on other non-key attributes)

**Example (Not 3NF):**
Employee (EmployeeID, Name, Department, DepartmentLocation)

**3NF Solution:**
Employee (EmployeeID, Name, DepartmentID)
Department (DepartmentID, DepartmentName, Location)


**Exercise 3.1:** Normalize this table to 3NF:
CustomerOrder (OrderID, CustomerID, CustomerName, ProductID, ProductName, Quantity, UnitPrice, Discount)

<details>
<summary>Solution</summary>

**3NF Solution:**
Customer (CustomerID, CustomerName)
Product (ProductID, ProductName, UnitPrice)
Order (OrderID, CustomerID, OrderDate)
OrderItem (OrderItemID, OrderID, ProductID, Quantity, Discount)

</details>
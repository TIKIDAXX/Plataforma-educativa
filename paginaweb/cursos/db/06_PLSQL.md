## 6. PL/SQL with Examples

PL/SQL is Oracle's procedural extension to SQL.

### Basic Structure
```sql
DECLARE
    -- Variable declarations
BEGIN
    -- Executable statements
EXCEPTION
    -- Exception handling
END;
Example: Stored Procedure

CREATE OR REPLACE PROCEDURE UpdateSalary(
    emp_id IN NUMBER,
    increase_pct IN NUMBER
) AS
    current_salary NUMBER;
BEGIN
    SELECT salary INTO current_salary FROM employees WHERE employee_id = emp_id;
    
    UPDATE employees 
    SET salary = current_salary * (1 + increase_pct/100)
    WHERE employee_id = emp_id;
    
    COMMIT;
    DBMS_OUTPUT.PUT_LINE('Salary updated for employee ' || emp_id);
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Employee not found');
END UpdateSalary;
Example: Trigger

CREATE OR REPLACE TRIGGER audit_employee_changes
BEFORE UPDATE OR DELETE ON employees
FOR EACH ROW
BEGIN
    INSERT INTO employee_audit (
        employee_id,
        change_type,
        change_date,
        old_salary,
        new_salary
    ) VALUES (
        :OLD.employee_id,
        CASE WHEN UPDATING THEN 'UPDATE' ELSE 'DELETE' END,
        SYSDATE,
        :OLD.salary,
        :NEW.salary
    );
END;
```
**Exercise 6.1**: Create a PL/SQL function that calculates the total sales for a given product ID.

<details> 
<summary>Solution</summary>

```sql
CREATE OR REPLACE FUNCTION GetProductSales(
    p_product_id IN NUMBER
) RETURN NUMBER IS
    v_total_sales NUMBER := 0;
BEGIN
    SELECT SUM(quantity * unit_price)
    INTO v_total_sales
    FROM order_items
    WHERE product_id = p_product_id;
    
    RETURN NVL(v_total_sales, 0);
EXCEPTION
    WHEN OTHERS THEN
        RETURN 0;
END GetProductSales;
```
</details>

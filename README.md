# Library Management System (API)

## 1. Project Analysis
A simple Library Management System built with **Laravel 12** and **Laravel Sanctum**, providing a RESTful API to manage:
- **Books**
- **Authors**
- **Categories**
- **Publishers**
- **Copies** (physical book copies)
- **Loans** (borrow/return transactions)
- **Users**

**Processing Flow:**  
`HTTP Request → Form Request → Controller → Service → Model → Database`

**Layer Hierarchy:**  
`Service → Controller → Form Request → Model`  
(Service at the top, followed by Controller, etc.)

This structure ensures clear separation of concerns, easy testing, and maintainability.

---

## 2. Required Entities
- User  
- Author  
- Category  
- Publisher  
- Book  
- Copy  
- Loan  

---

## 3. Entity Attributes

### 3.1 User
- **id**: `bigIncrements`  
- **name**: `string`  
- **email**: `string`, unique  
- **password**: `string`  
- **created_at**, **updated_at**: `timestamps`  

### 3.2 Author
- **id**  
- **name**: `string`  
- **bio**: `text`, nullable  
- **birth_date**: `date`, nullable  
- **nationality**: `string`, nullable  
- **created_at**, **updated_at**  

### 3.3 Category
- **id**  
- **name**: `string`, unique  
- **created_at**, **updated_at**  

### 3.4 Publisher
- **id**  
- **name**: `string`, unique  
- **address**: `string`, nullable  
- **contact_info**: `string`, nullable  
- **website**: `string`, nullable  
- **created_at**, **updated_at**  

### 3.5 Book
- **id**  
- **title**: `string`  
- **description**: `text`, nullable  
- **published_at**: `date`, nullable  
- **publisher_id**: `foreignId`, nullable → `onDelete('set null')`  
- **created_at**, **updated_at**  
- **علاقات**:  
  - `authors` (many-to-many)  
  - `categories` (many-to-many)  

### 3.6 Copy
- **id**  
- **book_id**: `foreignId` → `cascade`  
- **barcode**: `string`, unique  
- **status**: `enum('available','on_loan','lost')`  
- **created_at**, **updated_at**  

### 3.7 Loan
- **id**  
- **user_id**: `foreignId` → `cascade`  
- **copy_id**: `foreignId` → `cascade`  
- **loaned_at**: `dateTime`  
- **due_at**: `dateTime`  
- **returned_at**: `dateTime`, nullable  
- **created_at**, **updated_at**  

## 4. Relationships Between Entities

### 4.1 Book ↔ Author  
- **Relationship Type:** `many-to-many`  
- **Pivot Table:** `author_book`  
- **Foreign Keys:** `author_book.author_id`, `author_book.book_id`  
- **Reason:**  
  - A single book can be written by multiple authors (e.g., co-authored works).  
  - An author can write multiple books.

### 4.2 Book ↔ Category  
- **Relationship Type:** `many-to-many`  
- **Pivot Table:** `book_category`  
- **Foreign Keys:** `book_category.book_id`, `book_category.category_id`  
- **Reason:**  
  - A book may belong to multiple categories (e.g., “Science Fiction” and “Adventure”).  
  - A category can contain many different books.

### 4.3 Publisher → Book  
- **Relationship Type:** `one-to-many`  
- **Foreign Key:** `books.publisher_id`  
- **Reason:**  
  - A publisher can publish multiple books.  
  - Each book is typically published by one publisher.

### 4.4 Book → Copy  
- **Relationship Type:** `one-to-many`  
- **Foreign Key:** `copies.book_id`  
- **Reason:**  
  - A single book title can have multiple physical copies in the library.  
  - Each copy is tracked individually (e.g., via a unique barcode).

### 4.5 Copy → Loan  
- **Relationship Type:** `one-to-many`  
- **Foreign Key:** `loans.copy_id`  
- **Reason:**  
  - Each physical copy can be borrowed (loaned) many times over its lifetime.  
  - The `loans` table records every borrow/return event for that copy.

### 4.6 User → Loan  
- **Relationship Type:** `one-to-many`  
- **Foreign Key:** `loans.user_id`  
- **Reason:**  
  - A library user can borrow multiple copies over time.  
  - Each loan record ties a user to a specific copy and its loan dates.
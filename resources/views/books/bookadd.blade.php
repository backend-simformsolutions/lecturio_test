<!DOCTYPE html>
<html>
<head><title>Book Index</title>
<link href="/css/lib.css" rel="stylesheet">
</head>
<body>
<h2>Add Book</h2>

<hr/>

<form action="{{ route('books.store') }}" method="post">

{{ csrf_field() }}

  <label for="title">Title</label>
  <input type="text" name="title" value="">
  <br/><br/>
  <label for="isbn">ISBN</label>
  <input type="text" name="isbn" value="">
  <br/><br/>
  <label for="author">Author</label>
  <input type="text" name="author" value="">
  <br/><br/>
  <label for="category">Category</label>
  <input type="text" name="category" value="">
  <br/><br/>
  <label for="category">DB</label>
  <select name="dbtype">
    <option> Both </option>
    <option> MySql </option>
    <option> MongoDB </option>
  </select>
  <br/><hr/><br />

  <input type="button" class="book-action big" value="Cancel" onclick="window.location='{{ route('books.index') }}'">
  <input type="reset" class="book-action big">
  <input type="submit" class="book-action big" value="Submit">

</form>


</body>
</html>
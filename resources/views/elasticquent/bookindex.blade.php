<!DOCTYPE html>
<html>
<head>
<title>Book Index</title>
<link href="/css/lib.css" rel="stylesheet">
<style type="text/css">
	th{
		text-align: left !important; 
	}
</style>
</head>
<body>
	<h2><input type="button" class="book-action big" value="Add a Book" onclick="window.location='{{ route('books.create') }}'"></h2>

<h1>Welcome to Library (MongoDB)</h1>
<table width="1000px">
<th>No</th><th>Book Title</th><th>ISBN</th><th>Author</th><th>Category</th>
<tbody>
@foreach ($books as $i => $book)
		<tr>
			<td>{{ $i+1 }}</td>
			<td>{{ $book{'title'} }}</td>
			<td>{{ isset( $book{'isbn'} ) ?  $book{'isbn'} : ' - ' }}</td>
 			<td>{{ $book{'author'} }}</td>
 			<td>{{ $book{'category'} }}</td>

		</tr>
@endforeach
</tbody>
</table>
<hr/>
<br>
<br>

<h1>Welcome to Library (MySql)</h1>
<table width="1000px">
<th>No</th><th>Book Title</th><th>ISBN</th><th>Author</th><th>Category</th>
<tbody>
<?php $j=1; ?>
@foreach ($books_mysql as $i)
		<tr>
			<td>{{ $j++ }}</td> 
			<td>{{ $i->title }}</td>
			<td>{{ isset( $i->isbn ) ?  $i->isbn : ' - ' }}</td>
 			<td>{{ $i->author }}</td>
 			<td>{{ $i->category }}</td>

		</tr>
@endforeach
</tbody>
</table>
<hr/>
</body>
</html>
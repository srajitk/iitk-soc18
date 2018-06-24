<html>
<head>
		<script src = "jquery.js"></script>		
		<script src = "placeorder.js"></script>
</head>
<body>
	<input type="radio" name="xxx" value="fruits" checked> Fruits
	<input type="radio" name="xxx" value="vegetables"> Vegetables<br/>
	<select name="frfood" class="fruits"style="display:block">
		<option value="kela">Kela</option>
		<option value="tamatar">Tamatar</option>
		<option value="nimbu">Lemon</option>
	</select>
	<select name="vefood" class="vegetables" style="display:none">
		<option>Aloo</option>
		<option>Pyaaz</option>
		<option>Lauki</option>
	</select>
	<h6>Quality(in Kg)</h6>
	A: <input type="number" name='a'>
	B: <input type="number" name='b'>
	C: <input type="number" name='c'>
	Total Cost (in Rs)<input type="number" name="cost" required>
	Transport Required?<input type="checkbox" name="transport">
	Date of harvest<input type="date" name="doharvest" required>
	Date of delivery<input type="date" name="dodeliv" required>
	
	<input type="submit" value="Place Order" id="place">
</body>
</html>
<style>

    form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    
    label {
        font-weight: bold;
    }
    
    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    h1{
        text-align: center;
    }
</style>


<h1>New Scheme Creation</h1>
<form action="{{ url('/') }}/scheme-create" method="POST">
    @csrf <!-- Laravel CSRF protection -->
    <label for="name">Scheme Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="starting_year">Starting Year:</label><br>
    <input type="number" id="starting_year" name="starting_year" min="1900" max="2100" required><br><br>
    
    {{-- <label for="status">Status:</label><br>
    <select id="status" name="status" required>
        <option value="Pending">Pending</option>
        <option value="Ongoing">Ongoing</option>
        <option value="Completed">Completed</option>
    </select><br><br> --}}
    
    <input type="submit" value="Create Scheme">
</form>

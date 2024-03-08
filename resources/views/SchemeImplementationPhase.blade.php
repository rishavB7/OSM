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


<h1>Scheme implementaion Phase</h1>
<form action="{{ url('/') }}/scheme-implement" method="POST">
    @csrf <!-- Laravel CSRF protection -->

    <label for="imp_date">Date of Implementaion:</label><br>
    <input type="date" id="imp_date" name="imp_date" required><br><br>

    <label for="status">Status:</label><br>
    <select id="status" name="status" required>
        <option value="Pending">Pending</option>
        <option value="Ongoing">Ongoing</option>
        <option value="Completed">Completed</option>
    </select><br><br>
    
    <label for="phy_perform">Physical Performance:</label><br>
    <input type="text" id="phy_perform" name="phy_perform" required><br><br>

    <label for="percent_progress">% Of Progress:</label><br>
    <input type="number" id="percent_progress" name="percent_progress" min="0" max="100" required><br><br>
    
    <label for="photo">Upload Photo:</label><br>
    <input type="file" id="photo" name="photo"><br><br>

</form>

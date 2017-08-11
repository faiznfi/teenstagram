
<form id="myForm">

    <label>Your Name</label>
    <input type="text" name="myName">

    <label>Pick a file</label>
    <input type="file" name="myFile">

    <input type="submit" value="Upload File" 
               onclick="google.script.run
                        .uploadFiles(this.parentNode);
                        return false;">
</form>
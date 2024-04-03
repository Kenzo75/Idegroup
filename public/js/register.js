document.getElementById('role').addEventListener('change', function() {
    var role = this.value;
    if (role === 'user') {
        document.getElementById('user-section').style.display = 'block';
    } else {
        document.getElementById('user-section').style.display = 'none';
    }
});

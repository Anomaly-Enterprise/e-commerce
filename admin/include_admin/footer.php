
        </main>
    </div>
</div>

<footer class="footer">
    <div class="new-copy" style="display: flex; justify-content: center; align-items: center; text-align: center; padding: 20px;">
        <p style="font-size: 14px; color: #888;">&copy; 2023 Anomaly Enterprise. All rights reserved.</p>
        <p style="font-size: 16px; margin-left: 10px;">Crafted with <span style="color: #e74c3c;">&#9829;</span> by <span style="color: white; font-weight: bold;">Charmi Kalyani</span></p>
    </div>
</footer>
<script>
function showSection(sectionId) {
    var sections = document.querySelectorAll('.dashboard-section');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });
    
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}
function showAddProducts() {
    var addProductPopup = document.getElementById('addProductPopup');
    addProductPopup.style.display = 'block';
}

function closePopup() {
    var addProductPopup = document.getElementById('addProductPopup');
    addProductPopup.style.display = 'none';
}

// function exportProducts() {
//     // Implement logic to export products
// }

// function importProducts() {
//     // Implement logic to import products
// }
</script>

</body>
</html>

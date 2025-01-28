function openModal(id, name, description, price, stock, image) {
    document.getElementById('modal').classList.add('active');
    document.getElementById('modal_id').value = id;
    document.getElementById('modal_product_name').value = name;
    document.getElementById('modal_description').value = description;
    document.getElementById('modal_price').value = price;
    document.getElementById('modal_stock').value = stock;
    document.getElementById('modal_current_image').value = image;
    document.getElementById('delete_link').href = "product.php?delete=" + id;

    // Remove existing image preview if present
    const existingPreview = document.querySelector('.modal-content img');
    if (existingPreview) existingPreview.remove();

    // Add image preview if image exists
    if (image) {
        const modalImage = document.createElement('img');
        modalImage.src = image;
        modalImage.alt = "Product Image";
        modalImage.style.width = "100px";
        modalImage.style.marginTop = "10px";
        modalImage.style.display = "block"; /* Ensure proper layout */
            ocument.querySelector('.modal-content').appendChild(modalImage);
    }
        
    }
    function closeModal() {
        document.getElementById('modal').classList.remove('active');
    }



const signUpButton=document.getElementById('signUpButton');
const signInButton=document.getElementById('signInButton');
const signInForm=document.getElementById('signIn');
const signUpForm=document.getElementById('signup');

signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
signInButton.addEventListener('click', function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";
})
<footer class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-2 mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Features</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Pricing</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">FAQs</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">About</a>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Features</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Pricing</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">FAQs</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">About</a>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Features</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">Pricing</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">FAQs</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-white">About</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-5 offset-md-1 mb-3">
                <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of what's new and exciting from us.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address" />
                        <button class="btn btn-danger" type="button">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
            <p>© 2023 Company, Inc. All rights reserved.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">Facebook</a>
                </li>
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">Instagram</a>
                </li>
                <li class="ms-3">
                    <a class="link-body-emphasis" href="#">X</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!-- Toast noti -->
<div class="toast-container position-fixed p-3" style="top: 10%; right:0;">
    <div id="liveToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex justify-content-between align-items-center">
            <div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg></div>

            <div class="toast-body fs-5">
                Thông báo
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <hr class="m-0">
        <div class="fs-6 p-2" id="toast-data">Data</div>
    </div>
</div>
<script>
    const cartItemsNumber = document.getElementById('cartItemsNumber');
    const showToast = (idToast, idData, data) => {
        const toast = document.getElementById(idToast)
        document.getElementById(idData).innerText = data;
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast)
        toastBootstrap.show()
    }
    const updateCartItemsNumber = (num) => {
        cartItemsNumber.innerText = num;
    }
    const addCart = (e, id) => {
        e.preventDefault();
        var id = id;
        //var quantity = $(".product .quantity")[index].value;
        console.log(id);
        $.ajax({
            url: '<?= ROOT ?>/cart/add',
            type: 'POST',
            data: {
                id: id,
                //quantity: quantity
            },
            success: function(response) {
                // Handle the success response, if needed
                console.log('Success:', response);
                updateCartItemsNumber(response);
                showToast('liveToast', 'toast-data', "Bạn đã thêm sản phẩm vào giỏ hàng thành công!")
            },
            error: function(error) {
                // Handle the error, if any
                console.error('Error:', error);
                showToast('liveToast', 'toast-data', "Có lỗi xảy ra!")
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
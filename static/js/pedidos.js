const addToShoppingCartButtons =  document.querySelectorAll('.addToCart');
addToShoppingCartButtons.forEach('addCartButtton =>' {
                                 addToCartButton.addEventListener('click', addToCartClicked);
                                 });
const modal = document.querySelector('.modal');

function addToCartClicked(event) {
    const button = evenet.target;
    const pedido= button.closest('.pedido');
    const nombre= .pedido.querySelector('.card-title').textContent;
    
    const precio= .pedido.querySelector('.price').textContent;
    const imagen= .pedido.querySelector('.card-body').src;
    
    
    addItemToShoppingCart(nombre, precio, imagen);
}

function addItemToShoppingCart(nombre, precio, imagen) {
    const shoppingCartRow = document.createElement('div');
    cont contenido = `<div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-cart-plus pr-3"></i>Pedidos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <img src=${imagen}>
                          <p>${nombre}</p>
                          <p>${precio}</p>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                       
                      </div>
                    </div>
                  </div>`;
    
    shoppingCartRow.innerHTML = contenido
    contenedor.append(shoppingCartRow);
    
}
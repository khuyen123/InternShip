$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function string_to_slug (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}

function renderProducts(list) {
    let html = "";

    if (list == null) return "";

    // let i = 1;

    list.forEach(product => {
        console.log(product);
        html += `
<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
          <div class="row">
          <div class="col-md-4 product-men mt-md-0 mt-5">
          <div class="men-pro-item simpleCart_shelfItem">
          <div class="men-thumb-item text-center">
          <img src="${product.image}" alt="" width="150px" height="200px">
          <div class="men-cart-pro">
          <div class="inner-men-cart-pro">
          <a href="/san-pham/${product.product_id}-${string_to_slug(product.name)}.html" class="link-product-add-cart">Quick View</a>
          </div>
          </div>
          <span class="product-new-top">New</span>
          </div>
          <div class="item-info-product text-center border-top mt-4">
          <h4 class="pt-1">
          <a href="/san-pham/${product.product_id}-${string_to_slug(product.name)}.html">${product.name}</a>
          </h4>
          <div class="info-product-price my-2">
          <span class="item_price">${product.DonGia.toLocaleString()+' VNĐ'}</span>
          </div>
          <div
                                                        class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                        <form action="/add-cart" method="POST">
                                                            <fieldset>
                                                                <input type="hidden" name="cmd" value="_cart">
                                                                <input type="hidden" name="add" value="1">
                                                                <input type="hidden" name="business" value=" ">
                                                                <input type="hidden" name="item_name" value="${product.name}">
                                                                <input type="hidden" name="amount" value="${product.DonGia}">
                                                                <input type="hidden" name="currency_code" value="VND">
                                                                <input type="hidden" name="return" value=" ">
                                                                <input type="hidden" name="cancel_return" value=" ">
                                                                <input type="submit" name="submit" value="Thêm vào giỏ hàng" class="button btn"/>
                                                                <input type="hidden" name="productdetail_id" value="${product.id}">

                                                            </fieldset>
                                                        </form>
                                                    </div>
          </div>
          </div>
          </div>
          </div>
          </div>
        `;
    });
    return html;
}


function Search(idInput, url, idNullFeedback, idTable, renderFunc) {
    const input = document.getElementById(idInput);
    const nullFeedBack = document.getElementById(idNullFeedback);
    const table = document.getElementById(idTable);

    if (input == null) return;

    input.onkeyup = function () {
        let keyword = this.value.trim();

        setTimeout(() => {
            let text = this.value.trim();
            if (text === keyword) {
                $.ajax({
                    type: 'post',
                    datatype: 'JSON',
                    data: {keyword},
                    url: url,
                    success: function (result) {
                        table.innerHTML = renderFunc(result.list);
                        nullFeedBack.innerText = result.message;
                    }
                })
            }
        }, 200);
    }
}

Search('keyword', '/san-pham/search', 'products-null', 'product-table', renderProducts);

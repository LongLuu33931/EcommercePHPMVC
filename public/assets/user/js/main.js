// function addToCart(item) {
//   var itemID = $(item).attr("itemid");
//   console.log(itemID);
//   var quantityItem = $("input[name=quantityItemName]").val();
//   var cartCount = $("lblCartCount").text();
//   const productRemaining = "";
//   async function getQuantity() {
//     await $.ajax({
//       async: true,
//       type: "GET",
//       data: {
//         id: itemID,
//       },
//       url: "home/getquantity",
//       success: function (result) {
//         const data = JSON.parse(result);
//         productRemaining = data.Quantity;
//       },
//       error: function (err) {
//         console.error(err);
//       },
//     });
//     return productRemaining;
//   }

//   getQuantity().then((quantity) => {
//     let buyQuantity = 0;

//     if (buyQuantity > 0) {
//       if (quantityItem === "" || quantityItem <= 0) {
//         buyQuantity = 1;
//         $("input[name=quantityItemName]").val(1);
//       } else if (parseInt(quantityItem) <= parseInt(quantity)) {
//         buyQuantity = quantityItem;
//       } else {
//         buyQuantity = quantity;
//         $("input[name=quantityItemName]").val(quantity);
//         alert(`Bạn chỉ có thể mua tối đa ${quantity} sản phẩm`);
//       }
//       $.ajax({
//         async: true,
//         type: "POST",
//         dataType: "text",
//         data: {
//           product_id: itemID,
//           buyQuantity: buyQuantity,
//         },
//         url: "home/addtocart",
//         success: function (result) {
//           const data = JSON.parse(result);
//           if (data.isLogin) {
//             const success = `
//                         <div class="alert alert-success" style="text-align: center;">
//                         <strong>Thành công !</strong> Đã thêm sản phẩm vào giỏ hàng.
//                         </div> `;
//             $("#message").replaceWith(success);
//             if (data.cannotbuying) {
//               alert("Ban chỉ có thể mua tối đa " + soluong + " sản phẩm.");
//             }

//             $("#lblCartCount").text(data.cartCount);
//           } else {
//             const error = `
//                         <div class="alert alert-warning" style="text-align: center;">
//                         <strong>Cảnh báo !</strong> Bạn cần phải <a href="account.php">đăng nhập</a> để mua sản phẩm.
//                         </div>`;
//             $("#message").replaceWith(error);
//           }
//         },
//         error: function (err) {
//           console.error("err", err);
//         },
//       });
//     } else {
//       alert("Sản phẩm đã hết hàng");
//     }
//   });
// }

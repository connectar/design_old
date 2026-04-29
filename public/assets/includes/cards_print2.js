$(function () {

    window.addEventListener("showExportModel", (event) => {
        $("#cardExportModal").modal({
            keyboard: false,
            backdrop: false,
        });
        $("#cardExportModal").modal("handleUpdate");
        $("#cardExportModal").modal("show");
    });

    window.addEventListener("renderCardContainer", (event) => {
        $(".cardExportModal").modal("show");
        let items = event.detail.items;
        let priceStyles = items.price;
        $(".card-container").attr(
            "style",
            "background:url(" +
                items.image.src +
                ") no-repeat;background-size: 100% 100%;"
        );
        $("#cardPriceItem").css({
            left: priceStyles.x + "px",
            top: priceStyles.y + "px",
            "font-size": priceStyles.fontsize + "px",
            "font-family": priceStyles.font,
            color: priceStyles.color,
        });
        $("#cardSerialItem").css({
            left: items.serial.x + "px",
            top: items.serial.y + "px",
            "font-size": items.serial.fontsize + "px",
            "font-family": items.serial.font,
            color: items.serial.color,
        });
    });

    window.addEventListener("exportCardsAsPdf", (event) => {
       /**
        * 2 cards in row : 10 - cardWidth : 80 - marginBetwwn : 30 cardWidth - 10;
        * 3 cards in row : 5 - cardWidth : 60 - marginBetwwn : 10 cardWidth - 10 - cardWidth - 5;
        */
        console.log(event.detail.cards);
        let cards = event.detail.cards;
        let backgroundImage = event.detail.items.image.src;
        let serialPorb = event.detail.items.serial;
        let pricePorb = event.detail.items.price;
        let marginTop = 10;
        let marginLeft = 10;
        let marginXBetween = 30;
        let columnsCountInRow = 2;
        let rowNumber = 0;
        let cardWidth = 80;
        let cardHeight= 45;
        let columnNumber = 0,cardX,cardY;

        console.log(serialPorb,pricePorb);

        var doc = new jsPDF();

        for (
            let index = 0, total = cards.length;
            index < total;
            index++
        ) {
            // console.log(event.detail.cards[index].username)

            console.log(cards[index]['price'])

            cardX = marginLeft + columnNumber * (cardWidth + marginXBetween);
            cardY = marginTop +  (rowNumber * cardHeight +rowNumber * marginTop);
            serialX = cardX + (parseInt(serialPorb.x)) /4.625;
            serialY = cardY + (parseInt(serialPorb.y) / 200) * cardHeight;
            priceX = cardX + (parseInt(pricePorb.x)) /4.625;
            priceY = cardY + (parseInt(pricePorb.y) / 200) * cardHeight;


            doc.addImage(backgroundImage, "JPEG",cardX, cardY, cardWidth, cardHeight);
            doc.setTextColor(255, 0, 0);
            doc.setFontSize(serialPorb.fontsize * 0.625 * 1.04);
            doc.text(serialX * 1.04, serialY* 1.04, cards[index].username);
            doc.setTextColor(255, 0, 0);
            doc.setFontSize(pricePorb.fontsize * 0.625 * 1.04);
            doc.text(priceX* 1.04, priceY* 1.04, cards[index]['price']);

            //set column number
            columnNumber++;

            if(columnNumber == columnsCountInRow){
                rowNumber ++;
                columnNumber = 0;
            }

        }

       doc.save("cards.pdf");
       delete doc;
    });

    // varlabel_bin = parseInt(left_label_bin) - 17; left_label_bin = "158";
    // left_
    // left_label_bin = left_label_bin / 4.625;
    // var top_label_bin = "33";
    // top_label_bin = parseInt(top_label_bin) / 200;
    // top_label_bin = top_label_bin * 45;
    // var color_label_bin = "";


    // var left_price = "51";
    // left_price = parseInt(left_price) - 17;
    // left_price = left_price / 4.625;
    // var top_price = "98";
    // top_price = parseInt(top_price) / 200;
    // top_price = top_price * 45;
    // var color_price = "";
    // var font_user = "16";
    // var font_price = "16";
    // font_user = parseInt(font_user) * 0.625;
    // font_price = parseInt(font_price) * 0.625;

    // function numcards(obj) {
    //     var c = 0;
    //     for (var key in obj) {
    //         if (obj.hasOwnProperty(key)) ++c;
    //     }
    //     return c;
    // }
    // function hexToRgb(hex) {
    //     var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    //     return result
    //         ? {
    //               r: parseInt(result[1], 16),
    //               g: parseInt(result[2], 16),
    //               b: parseInt(result[3], 16),
    //           }
    //         : null;
    // }

    // var x = 0;
    // y = 10;
    // ipp = 0;
    // for (var i = 0; i < numcards(cardsData); i++) {
    //     try {
    //         doc.addImage(data_img, "JPEG", x * 90 + 20, y, 80, 45);
    //     } catch (err) {
    //         doc.addImage(data_img2, "JPEG", x * 90 + 20, y, 80, 45);
    //     }

    //     var pinX = x * 90 + 20.6 + left_label_bin;
    //     var pinY = y + 4.4 + top_label_bin * 1.04;

    //     if (color_label_bin) {
    //         if (hexToRgb(color_label_bin)) {
    //             var cR = hexToRgb(color_label_bin).r;
    //             var cG = hexToRgb(color_label_bin).g;
    //             var cB = hexToRgb(color_label_bin).b;
    //             doc.setTextColor(cR, cG, cB);
    //         } else {
    //             var cR = color_label_bin.r;
    //             var cG = color_label_bin.g;
    //             var cB = color_label_bin.b;
    //             doc.setTextColor(cR, cG, cB);
    //         }
    //     } else {
    //         doc.setTextColor(1, 1, 1);
    //     }
    //     try {
    //         doc.setFontSize(font_user * 1.04);
    //     } catch (err) {
    //         doc.setFontSize(10);
    //     }
    //     doc.text(pinX, pinY, cardsData[i].pin_card);

    //     var pinX = x * 90 + 20.6 + parseInt(left_price);
    //     var pinY = y + 4.4 + parseInt(top_price) * 1.04;
    //     if (color_price) {
    //         if (hexToRgb(color_price)) {
    //             var cR = hexToRgb(color_price).r;
    //             var cG = hexToRgb(color_price).g;
    //             var cB = hexToRgb(color_price).b;
    //             doc.setTextColor(cR, cG, cB);
    //         } else {
    //             var cR = color_price.r;
    //             var cG = color_price.g;
    //             var cB = color_price.b;
    //             doc.setTextColor(cR, cG, cB);
    //         }
    //     } else {
    //         doc.setTextColor(1, 1, 1);
    //     }
    //     try {
    //         doc.setFontSize(font_price * 1.04);
    //     } catch (err) {
    //         doc.setFontSize(10);
    //     }
    //     doc.text(pinX, pinY, cardsData[i].price);

    //     x++;
    //     if (x == 2) {
    //         x = 0;
    //         y = y + 50;
    //     }
    //     ipp++;
    //     if (ipp > 9) {
    //         ipp = 0;
    //         x = 0;
    //         y = 10;
    //         try {
    //             if (cardsData[i + 1].pin_card) {
    //                 doc.addPage("a4", "p");
    //             }
    //         } catch (err) {}
    //     }
    // }
    // doc.save("cards.pdf");
    // delete doc;
    /*** */
});

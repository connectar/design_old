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
        let card = event.detail.card;

        $(".cardExportModal").modal("show");
        $(".card-container").css(card.cardStyle);
        $("#cardPriceItem").css(card.itemsStyle.price);
        $("#cardPriceItem").text(card.itemsValue.price);
        $("#cardSerialItem").css(card.itemsStyle.serial);
        $("#cardSerialItem").text(card.itemsValue.serial);
        $("#cardQrItem").css(card.itemsStyle.qr);
        $("#cardQrItem").text(card.itemsValue.qr);
    });

    window.addEventListener("exportCardsAsPdf", (event) => {
        /**
         * 2 cards in row : 10 - cardWidth : 80 - marginBetwwn : 30 cardWidth - 10;
         * 3 cards in row : 5 - cardWidth : 60 - marginBetwwn : 10 cardWidth - 10 - cardWidth - 5;
         */
        console.log(event.detail);

        function hexToRgb(hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : {
                r: 255,
                g: 255,
                b: 255
            };
        }

        function dottedLine(doc, xFrom, yFrom, xTo, yTo, segmentLength) {
            // Calculate line length (c)
            var a = Math.abs(xTo - xFrom);
            var b = Math.abs(yTo - yFrom);
            var c = Math.sqrt(Math.pow(a, 2) + Math.pow(b, 2));

            // Make sure we have an odd number of line segments (drawn or blank)
            // to fit it nicely
            var fractions = c / segmentLength;
            var adjustedSegmentLength = (Math.floor(fractions) % 2 === 0) ? (c / Math.ceil(fractions)) : (c / Math.floor(fractions));

            // Calculate x, y deltas per segment
            var deltaX = adjustedSegmentLength * (a / c);
            var deltaY = adjustedSegmentLength * (b / c);

            var curX = xFrom,
                curY = yFrom;
            while (curX <= xTo && curY <= yTo) {
                doc.line(curX, curY, curX + deltaX, curY + deltaY);
                curX += 2 * deltaX;
                curY += 2 * deltaY;
            }
        }

        function convertFromPixelUnitToMilimiterUnit(value) {
            return (parseInt(value) / 3.779528);
        }

        function setLabelX(labelX, cardX) {
            return convertFromPixelUnitToMilimiterUnit(labelX) + cardX;
        }

        function setLabelY(labelY, cardY) {
            return convertFromPixelUnitToMilimiterUnit(labelY) + cardY;
        }

        let cards = event.detail.cards;
        let backgroundImage = event.detail.items.card.background;
        let serialPorb = event.detail.items.items.serial;
        let qrPorb = event.detail.items.items.serial;
        let pricePorb = event.detail.items.items.price,
            // can edit those
            cardWidth = 80,
            // cardHeight = 45, old
            cardHeight = 25,
            cardsPerPage = 16,
            marginLeft = 10,
            marginTop = 10,
            marginXBetween = 30,
            columnsCountInRow = 2,
            // don't edit it
            rowNumber = 0,
            columnNumber = 0,
            cardX = 0,
            cardY = 0,
            filledCardsPerPage = 0;

        var doc = new jsPDF('p', 'mm', 'a4');
        doc.setFontSize(14);
        doc.setFontType("bold");

        for (
            let index = 0, total = cards.length; index < total; index++
        ) {
            // set x,y form card and items
            cardX = marginLeft + columnNumber * (cardWidth + marginXBetween);
            cardY = marginTop + (rowNumber * cardHeight + rowNumber * marginTop);
            // add image
            try {
                doc.addImage(backgroundImage, "JPEG", cardX, cardY, cardWidth, cardHeight);
            } catch (err) {
                doc.rect(cardX, cardY, cardWidth, cardHeight)
            }
            doc.setFontSize(serialPorb['font-size']);

            fontColor = hexToRgb(serialPorb.color);
            doc.setTextColor(fontColor.r, fontColor.g, fontColor.b);

            doc.text(
                setLabelX(serialPorb.x, cardX),
                setLabelY(serialPorb.y, cardY),
                cards[index].username
            );

            doc.setFontSize(pricePorb['font-size']);
            fontColor = hexToRgb(pricePorb.color);
            doc.setTextColor(fontColor.r, fontColor.g, fontColor.b);
            doc.text(
                setLabelX(pricePorb.x, cardX),
                setLabelY(pricePorb.y, cardY),
                cards[index].price
            );
            if (rowNumber > 0) {
                // horizontal line
                dottedLine(doc, 0, cardY - (marginTop / 2), 600, cardY - (marginTop / 2), 3);
            }
            if (columnNumber > 0) {
                dottedLine(doc,
                    cardX - (marginXBetween / 2),
                    0,
                    cardX - (marginXBetween / 2),
                    500, 3);
            }

            //set column number
            columnNumber++;
            // to add new page
            filledCardsPerPage++;
            // this to reset columns order.
            if (columnNumber == columnsCountInRow) {
                columnNumber = 0;
                rowNumber++;
            }

            //this to add new page
            if (filledCardsPerPage == cardsPerPage) {
                filledCardsPerPage = 0;
                rowNumber = 0;
                columnNumber = 0;
                // this to deny add empty page in last of file
                if (index + 1 < total) {
                    doc.addPage();
                }
            }

        }

        doc.save("cards.pdf");
        delete doc;
        $("#cardExportModal").modal("hide");

    });

});

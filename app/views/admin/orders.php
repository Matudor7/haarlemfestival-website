<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <div class="container-fluid">
        <h1>Manage Orders</h1>
        <button class="btn btn-success" type="button" style="float: right; margin-left: 10px" onclick="getAllCheckedBoxes()">Export Table</button>
        <button class="btn btn-primary" type="button" style="float: right" onclick="window.location.href = '/admin/generateApiKey' ">Generate Key</button>
        <section>
            <table class="table" id="ordersTable">
                <thead>
                    <tr>
                        <th scope="col">
                        <input type="checkbox" id="orderIdCheckbox" class="headerCheckbox" checked>   
                        Order ID</th>
                        <th scope="col">
                        <input type="checkbox" id="paymentIdCheckbox" class="headerCheckbox" checked>
                        Payment ID</th>
                        <th scope="col">
                        <input type="checkbox" id="invoiceNumberCheckbox" class="headerCheckbox" checked>    
                        Invoice Number</th>
                        <th scope="col">
                        <input type="checkbox" id="invoiceDateCheckbox" class="headerCheckbox" checked>    
                        Invoice Date</th>
                        <th scope="col">
                        <input type="checkbox" id="productsCheckbox" class="headerCheckbox" checked>    
                        Products</th>
                        <th scope="col">
                        <input type="checkbox" id="paymentStatusCheckbox" class="headerCheckbox" checked>    
                        Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order){?>
                    <tr>
                        <th scope="row"><?php echo $order->getOrderId()?></th>
                        <td><?php echo $order->getPaymentId()?></td>
                        <td><?php echo $order->getInvoiceNumber()?></td>
                        <td><?php echo $order->getInvoiceDate()?></td>
                        <td><?php echo $order->getListProductId()?></td>
                        <td><select name="paymentStatuses" id="<?php echo "paymentStatus " . $order->getOrderId()?>" onchange="updateField(<?php echo $order->getOrderId()?>)">
                                <option value="Paid" <?php if($order->getPaymentStatus() == "Paid") echo 'selected'?>>Paid</option>
                                <option value="Pending" <?php if($order->getPaymentStatus() == "Pending") echo 'selected'?>>Pending</option>
                                <option value="Cancelled" <?php if($order->getPaymentStatus() == "Cancelled") echo 'selected'?>>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
    <script>
        function getAllCheckedBoxes(){
            const headerCheckboxes = document.querySelectorAll('.headerCheckbox');

            const columnData = [];

            headerCheckboxes.forEach((checkbox, columnIndex) =>{
               if(checkbox.checked){
                    const cells = document.querySelectorAll(`#ordersTable td:nth-child(${columnIndex + 1})`);

                    const column = Array.from(cells).map(cell => cell.textContent.trim());

                    columnData.push(column);
               } 
            });

            const csvString = convertToCsv(columnData);
        }

        function convertToCsv(array){
            const csvRows = [];

            for (const row of array) {
                const csvColumns = [];

                for (const cellValue of row) {
                let csvCellValue = cellValue;

                // Escape double quotes by doubling them
                csvCellValue = csvCellValue.replace(/"/g, '""');

                // Enclose cell value in double quotes if it contains a comma, line break, or double quotes
                if (csvCellValue.includes(',') || csvCellValue.includes('\n') || csvCellValue.includes('"')) {
                    csvCellValue = `"${csvCellValue}"`;
                }

                csvColumns.push(csvCellValue);
                }

                csvRows.push(csvColumns.join(','));
            }

            csvRows.join('\n');
            downloadCsv('order_export.csv', csvRows);
    }

        function downloadCsv(filename, array){
            const downloadElement = document.createElement('a');

            downloadElement.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(array));
            downloadElement.setAttribute('download', filename);
            downloadElement.style.display = 'none';

            document.body.appendChild(downloadElement);
            downloadElement.click();
            document.body.removeChild(downloadElement);
        }

        function updateField(id){
            const paymentSelect = document.getElementById("paymentStatus " + id);

            const orderPaymentData = {
                "payment_status": paymentSelect.value
            };

            fetch("http://localhost/api/orders?id=" + id,{
                method: 'PATCH',
                headers:{
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(orderPaymentData),
            })
            .then((response) => response.json())
            .then((data)=> console.log(data))
            .catch((error)=> console.error(error));
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</html>
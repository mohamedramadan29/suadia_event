<html>

<head>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h4>فاتورة رقم: {{ $invoice->id }}</h4>
        <p> {{ $invoice->title }}</p>
        <p>اسم العميل: {{ $invoice->name }}</p>
        <p>رقم الهاتف: {{ $invoice->phone }}</p>
        <!-- عرض الباركود كصورة PNG -->
        <div>
            <img src="data:image/png;base64,{{ base64_encode($barcode) }}" />
        </div>
    </div>
    <style>
        .text-center {
            text-align: center;
        }
    </style>
</body>

</html>

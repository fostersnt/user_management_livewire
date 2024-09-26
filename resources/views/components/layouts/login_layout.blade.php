<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .image-column {
            flex: 1;
            background: url('your-image-url.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Hidden on small screens */
        }

        .form-column {
            flex: 1;
            padding: 40px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-border{
            border: 1px solid red !important;
        }

        /* Responsive Styles */
        @media (min-width: 768px) {
            .image-column {
                display: flex;
            }

            .form-column {
                padding: 60px;
            }
        }

        @media (max-width: 767px) {
            .container {
                flex-direction: column;
            }

            .image-column {
                display: none;
                /* Hidden on small screens */
            }

            .form-column {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    {{$slot}}
</body>

</html>
<script src="{{asset('assets/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/popper.min.js')}}"></script>

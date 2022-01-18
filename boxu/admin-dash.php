<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admin-dash.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item-logo"><a href="#" class="nav-link "><img src="./icons/logo.svg" class="logo-icon"> <span class="link-text logo">Boxu</span></a></li>
                <li class="nav-item"><a href="index.php" class="nav-link "><span class="iconify nav-icon" data-icon="el:home-alt"></span><span class="link-text">Home</span> </a></li>
                <li class="nav-item"><a href="admin-dash.php" class="nav-link active"><span class="iconify nav-icon" data-icon="fluent:person-24-filled"></span><span class="link-text">Admin Panel</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><span class="iconify nav-icon" data-icon="ri:logout-circle-r-line"></span><span class="link-text sign-out-link">Sign out</span></a></li>
            </ul>
        </nav>
    </header>
    <main>

        <div class="cards">
            <div class="number-of-user">
                <h4>Number of Users is 14</h4>
            </div>
            <div class="add-product">
                <h4>Add a Product</h4>
                <form action="">
                    <label for="productName">Product Name:</label>
                    <input type="text" name="productName" id="productName">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price">
                    <label for="cardColor">Choose a card color:</label>
                    <select name="card-color" id="cardcolor">
                        <option value="blue-box">blue</option>
                        <option value="red-box">red</option>
                        <option value="purple-box">purple</option>
                    </select>
                    <label for="">Choose product image:</label>
                    <label for="product-image-btn" class="picture-btn">Choose an image</label>
                    <input type="file" name="image" id="product-image-btn">
                    <button type="submit" class="confirm-btn">Confirm</button>
                </form>
            </div>
        </div>
        <div class="tables">
            <h4>Products table</h4>

            <div class="products-table">

                <table>
                    <thead>
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                image
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Modify
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="product1" value="1">
                                </td>
                                <td>
                                    <input type="text" name="price" value="16">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="product1" value="1">
                                </td>
                                <td>
                                    <input type="text" name="price" value="16">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="product1" value="1">
                                </td>
                                <td>
                                    <input type="text" name="price" value="16">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h4>Users table</h4>
            <div class="user-table">

                <table>
                    <thead>
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                image
                            </th>
                            <th>
                                First Name
                            </th>
                            <th>
                                Last Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                username
                            </th>
                            <th>
                                password
                            </th>
                            <th>
                                Modify
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="firstName" value="firstName">
                                </td>
                                <td>
                                    <input type="text" name="lastName" value="lastName">
                                </td>
                                <td>
                                    <input type="text" name="email" value="email">
                                </td>
                                <td>
                                    <input type="text" name="username" value="username">
                                </td>
                                <td>
                                    <input type="text" name="password" value="password">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="firstName" value="firstName">
                                </td>
                                <td>
                                    <input type="text" name="lastName" value="lastName">
                                </td>
                                <td>
                                    <input type="text" name="email" value="email">
                                </td>
                                <td>
                                    <input type="text" name="username" value="username">
                                </td>
                                <td>
                                    <input type="text" name="password" value="password">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <form action="">
                                <td>
                                    <input type="text" readonly class="id" name="" value="1">
                                </td>
                                <td class="image-container">
                                    <label class="imageUpdate" name="imageUpdate" type="submit" for="imageUpdatebtn">
                                        <span class="icon iconify " data-icon="mdi:pencil-circle-outline"></span>
                                    </label>
                                    <input style="width:0px;height:0px;margin : 0px;padding:0px" type="file" name="updatedimage" id="imageUpdatebtn">
                                    <img src="./product-imgs/bluebox.svg" alt="">
                                </td>
                                <td>
                                    <input type="text" name="firstName" value="firstName">
                                </td>
                                <td>
                                    <input type="text" name="lastName" value="lastName">
                                </td>
                                <td>
                                    <input type="text" name="email" value="email">
                                </td>
                                <td>
                                    <input type="text" name="username" value="username">
                                </td>
                                <td>
                                    <input type="text" name="password" value="password">
                                </td>
                                <td class="td-btns">
                                    <button class="delete" name="delete" type="submit">delete</button>
                                    <button class="update" name="update" type="submit">Update</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <p>copyright by Boxu since 2021</p>
    </footer>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
</body>

</html>
<?php

class ProductController extends BaseController
{
    private $productModel;
    private $categoryModel;
    private $brandModel;
    private $colorModel;
    private $seriModel;
    private $memoryModel;

    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;


        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;


        $this->loadModel('BrandModel');
        $this->brandModel = new BrandModel;

        $this->loadModel('ColorModel');
        $this->colorModel = new ColorModel;

        $this->loadModel('MemoryModel');
        $this->memoryModel = new MemoryModel;

        $this->loadModel('SeriModel');
        $this->seriModel = new SeriModel;


        parent::__construct();
    }

    public function index()
    {

        $this->listproduct();
    }

    public function listproduct()
    {
        Session::checkSession();
        // $products = $this->productModel->getallProduct();

        $data['products'] = $this->productModel->product();

        $product_count = count($data['products']);

        $product_button = ceil($product_count / 6);

        $data['product_button'] = $product_button;

        $sp_tungtrang = 6;

        if (!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }

        $tung_trang = ($trang - 1) * $sp_tungtrang;

        $data['productsPT'] = $this->productModel->productPage($sp_tungtrang, $tung_trang);


        $data['product_images'] = $this->productModel->getProductImages();

        $data['product_colors'] = $this->productModel->getColors();

        $data['colors'] = $this->colorModel->getColor();


        $this->view('layout.header');
        $this->view('product.index', $data);
        $this->view('layout.footer');
    }
    public function listHiddenProduct()
    {
        Session::checkSession();
        $data['hiddenProducts'] = $this->productModel->hiddenProduct();
        $this->view('layout.header');
        $this->view('product.listHiddenProduct', $data);
        $this->view('layout.footer');
    }
    public function addproduct()
    {
        Session::checkSession();
        $this->view('layout.header');

        $categories = $this->categoryModel->category();

        $brands = $this->brandModel->getallBrand();

        $colors = $this->colorModel->getColor();

        $memories = $this->memoryModel->getMemory();

        $this->view('product.store', [
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors,
            'memories' => $memories
        ]);
        $this->view('layout.footer');
    }
    // public function insertproduct(){
    //     $title = $_POST['title_product'];
    //     $desc = $_POST['desc_product'];
    //     $small_desc = $_POST['small_desc'];
    //     $price = $_POST['price_product'];
    //     $selling = $_POST['selling_product'];
    //     $hot = $_POST['hot_product'];
    //     $quanlity = $_POST['quanlity_product'];
    //     // $color = $_POST['color_product'];
    //     $memory = $_POST['memory_product'];

    //     //  Sử lý hình ảnh sản phẩm
    //     $image = $_FILES['image_product']['name'];
    //     $tmp_image = $_FILES['image_product']['tmp_name'];
    //     $div = explode('.', $image);
    //     $file_ext = strtolower(end($div));
    //     $unique_image = time() . '.' . $file_ext;
    //     $path_uploads = "public/uploads/product/" . $unique_image;

    //     // Kết thúc sử lý hình ảnh

    //     $category = $_POST['category_product'];
    //     $brand = $_POST['brand_product'];

    //     $colors = $_POST['colors'];
    //     $colorQuanlities = $_POST['colorquanlity'];

    //     $data = array(
    //         'title_product' => $title,
    //         'desc_product' => $desc,
    //         'small_desc' => $small_desc,
    //         'price_product' => $price,
    //         'selling_product' => $selling,
    //         'hot_product' => $hot,
    //         'quanlity_product' => $quanlity,
    //         // 'color_product' => $color,
    //         'memory_product' => $memory,
    //         'image_product' => $unique_image,
    //         'id_category_product' => $category,
    //         'brand_product' => $brand,
    //     );
    //     // print_r($data);

    //     // Thêm sản phẩm vào cơ sở dữ liệu
    //     $productId = $this->productModel->insertGetProduct($data);
    //     if ($productId) {
    //         move_uploaded_file($tmp_image, $path_uploads);
    //         header('Location:'.BASE_URL."/admin/product");
    //     }else{
    //         echo "lỗi thêm sản phẩm";
    //     }

    // }

    public function insertproduct()
    {
        $title = $_POST['title_product'];
        $desc = $_POST['desc_product'];
        $small_desc = $_POST['small_desc'];
        $price = $_POST['price_product'];
        $selling = $_POST['selling_product'];
        $hot = $_POST['hot_product'];
        $quanlity = $_POST['quanlity_product'];
        $memory = $_POST['memory_product'];
        $memory = $_POST['memory_product'];

        $data_properties = $_POST['data_properties'];
        $properties = "";
        if(isset($data_properties) && $data_properties != NULL){
            $properties = json_encode($data_properties,JSON_UNESCAPED_UNICODE);
        }
        

        //  Sử lý hình ảnh sản phẩm
        $image = $_FILES['image_product']['name'];
        $tmp_image = $_FILES['image_product']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = time() . '.' . $file_ext;
        $path_uploads = "public/uploads/product/" . $unique_image;

        // Kết thúc sử lý hình ảnh
        $category = $_POST['category_product'];
        $brand = $_POST['brand_product'];
        $seri = $_POST['seri_product'];

        $colors = $_POST['colors'];
        $colorQuanlities = $_POST['colorquanlity'];

        $data = array(
            'title_product' => $title,
            'desc_product' => $desc,
            'small_desc' => $small_desc,
            'price_product' => $price,
            'selling_product' => $selling,
            'hot_product' => $hot,
            'quanlity_product' => $quanlity,
            'memory_product' => $memory,
            'image_product' => $unique_image,
            'properties' => $properties,
            'id_category_product' => $category,
            'brand_product' => $brand,
            'seri_product' => $seri,
        );
        // Thêm sản phẩm vào cơ sở dữ liệu
        $productId = $this->productModel->insertGetProduct($data);
        echo ($productId);
        if ($productId) {
            move_uploaded_file($tmp_image, $path_uploads);
            // Lặp qua từng file hình ảnh sản phẩm

            // Lặp qua từng file hình ảnh sản phẩm
            if (!empty($_FILES['product_images']['name'])) {
                $imageUploadPath = "public/uploads/product_image/"; // Đường dẫn lưu hình ảnh
                $i=0;
                foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
                    $image = $_FILES['product_images']['name'][$key];
                    $file_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                    $unique_image = time() .$i++.  '.' . $file_ext;
                    $path_uploads = $imageUploadPath . $unique_image;

                    if (move_uploaded_file($tmp_name, $path_uploads)) {
                        // Chèn thông tin hình ảnh vào bảng image_product
                        $imageData = [
                            'id_product' => $productId,
                            'image_name' => $unique_image,
                        ];
                        $this->productModel->insertImageProduct($imageData);
                    }                    
                }
            }
            $i = 0;
            foreach ($colors as $colorId) {
                // Kiểm tra xem màu có tồn tại trong danh sách colorQuanlities không
                if (isset($colorQuanlities[$colorId]) && is_numeric($colorQuanlities[$colorId])) {
                    $colorQuanlity = intval($colorQuanlities[$colorId]);
                    $colorTitle = $_POST['title_products'][$colorId];
                    $colorPrice = $_POST['prices'][$colorId];

                    // Xử lý hình ảnh cho màu
                    $colorImageName = $_FILES['images']['name'][$colorId];
                    $colorImageTmp = $_FILES['images']['tmp_name'][$colorId];
                    $div = explode('.', $colorImageName);
                    $colorImageExt = strtolower(end($div));
                    $colorImageUnique = time() . $i++ . '.' . $colorImageExt;
                    $colorImagePath = "public/uploads/product_color/" . $colorImageUnique;

                    move_uploaded_file($colorImageTmp, $colorImagePath);

                    // Thêm thông tin màu vào cơ sở dữ liệu
                    $colorData = [
                        'product_id' => $productId,
                        'color_id' => $colorId,
                        'quanlity' => $colorQuanlity,
                        'title_product' => $colorTitle,
                        'price_product' => $colorPrice,
                        'image' => $colorImageUnique,
                    ];
                    print_r($colorData);
                    $result = $this->productModel->insertProductColor($colorData);
                    if ($result) {
                        header('Location:' . BASE_URL . "/admin/product");
                    }
                }
            }
            header('Location:' . BASE_URL . "/admin/product");
        }
    }

    public function deleteproduct($id)
    {

        $cond = "id_product='$id'";
        $cond2 = "product_id='$id'";
        $result = $this->productModel->deleteProduct($cond);
        $result_1 = $this->productModel->deleteImage($cond);
        $result_2 = $this->productModel->deleteColor($cond2);
        if ($result == 1) {
            $message['msg'] = "Xóa sản phẩm thành công";
            header("Location:" . BASE_URL . "/admin/product");
        } else {
            $message['msg'] = "Xóa sản phẩm thất bại";
            header("Location:" . BASE_URL . "/admin/product");
        }

    }

    public function editproduct($id)
    {
        Session::checkSession();

        $cond = "id_product='$id'";

        $data['productbyid'] = $this->productModel->productByid($cond);
        foreach($data['productbyid'] as $i){
            $data['arr_properties']=[];
            if($i['properties']!= null && $i['properties'] !="" ){
                $data['arr_properties'] = json_decode($i['properties'],true);
            };
        }
        
        $data['categories'] = $this->categoryModel->category();
        $data['brand'] = $this->brandModel->brandProduct();

        $data['color_product'] = $this->productModel->getColorById($id);

        $data['colors'] = $this->colorModel->getColor();

        $this->view('layout.header');
        $this->view('product.edit', $data);
        $this->view('layout.footer');
    }
    public function updateproduct($id)
    {
       
        $path_uploads = "C:/xampp/htdocs/demo/public/uploads/product";
        $path_uploads_productColor = "C:/xampp/htdocs/demo/public/uploads/product_color";
        $category = $_POST['category_product'];
        $cond = "id_product = '$id'";
        $seri_product = $_POST['seri_product'];
        $title = $_POST['title_product'];
        $desc = $_POST['desc_product'];
        $small_desc = $_POST['small_desc'];
        $price = $_POST['price_product'];
        $selling = $_POST['selling_product'];
        $hot = $_POST['hot_product'];
        $quanlity = $_POST['quanlity_product'];
        $memory = $_POST['memory_product'];
        $brand = $_POST['brand_product'];

        $data_properties = $_POST['data_properties'];
        $properties = "";
        if(isset($data_properties) && $data_properties != NULL){
            $properties = json_encode($data_properties,JSON_UNESCAPED_UNICODE);
        }
        // echo "<pre>";
        // print_r($properties);
        // die;
        
        // Lấy thông tin hình ảnh sản phẩm
        $image = $_FILES['image_product']['name'];
        $tmp_image = $_FILES['image_product']['tmp_name'];

        // Kiểm tra xem có hình ảnh mới không
        if (!empty($image)) {
            // Xóa hình ảnh cũ
            $data['productbyid'] = $this->productModel->productByid($cond);
            foreach ($data['productbyid'] as $key => $value) {
                $old_image = $value['image_product'];
                unlink($path_uploads . '/' . $old_image);
            }

            // Tải lên hình ảnh mới và cập nhật thông tin sản phẩm
            $div = explode('.', $image);
            $file_ext = strtolower(end($div));
            $unique_image = time() . '.' . $file_ext;
            $new_image_path = $path_uploads . '/' . $unique_image;
            move_uploaded_file($tmp_image, $new_image_path);

            $data = array(
                'title_product' => $title,
                'brand_product' => $brand,
                'seri_product' => $seri_product,
                'price_product' => $price,
                'hot_product' => $hot,
                'small_desc' => $small_desc,
                'desc_product' => $desc,
                'selling_product' => $selling,
                'quanlity_product' => $quanlity,
                'memory_product' => $memory,
                'image_product' => $unique_image,
                'properties' => $properties,
                'id_category_product' => $category,

            );
        } else {
            // Dữ liệu sản phẩm cơ bản
            $data = array(
                'title_product' => $title,
                'desc_product' => $desc,
                'seri_product' => $seri_product,
                'price_product' => $price,
                'selling_product' => $selling,
                'small_desc' => $small_desc,
                'hot_product' => $hot,
                'quanlity_product' => $quanlity,
                'memory_product' => $memory,
                'id_category_product' => $category,
                'properties' => $properties,
                'brand_product' => $brand,
            );
        }
        $ids = $_POST['ids'];
        if($ids!="" && $ids!= null){
            $colorQuanlities = $_POST['colorquanlity'];
            $colorTitles = $_POST['title_products'];
            
            $colorPrices = $_POST['prices'];
            $colorImages = $_FILES['images'];
            // print_r($colorImages);
            $i = 0;
            foreach ($ids as $Id) {
                $cond2 = "product_id = '$id' AND id = '$Id'";
                $colorExists = $this->productModel->checkColorExists($cond2);
                
                        $colorQuanlity = intval($colorQuanlities[$Id]);
                        $colorTitle = $colorTitles[$Id];
                        $colorPrice = $colorPrices[$Id];
                       
                        if($colorImages['name'][$Id]!=""){
                       
                            $colorImageName = $colorImages['name'][$Id];
                            $colorImageTmp = $colorImages['tmp_name'][$Id];
                            $div = explode('.', $colorImageName);
                            $colorImageExt = strtolower(end($div));
                            $colorImageUnique = time() . $i++ . '.' . $colorImageExt;
                            $colorImagePath = $path_uploads_productColor . '/' . $colorImageUnique;
                            move_uploaded_file($colorImageTmp, $colorImagePath);
                            foreach ($colorExists as $keys => $value) {
                                $oldColorImage = $value['image'];
                                unlink($path_uploads_productColor . '/' . $oldColorImage);
                            }
                            $colorData = [
                                'product_id'=> $id,
                                'quanlity' => $colorQuanlity,
                                'title_product' => $colorTitle,
                                'price_product' => $colorPrice,
                                'image' => $colorImageUnique,
                            ];
                          
                        }else{
                            foreach ($colorExists as $keys => $value) {
                                $img= $value['image']; 
                            }
                            $colorData = [
                                'product_id'=> $id,
                                'quanlity' => $colorQuanlity,
                                'title_product' => $colorTitle,
                                'price_product' => $colorPrice,
                                'image' => $img,
                            ];
                          
                        }
                $result2 = $this->productModel->updateProductColor($colorData, $cond2);
                    
            }
            if ($result2) {
                $result = $this->productModel->updateProduct($data, $cond);
                if ($result) {
                    header('Location:' . BASE_URL . "/admin/product");
                } else {
                    echo "Lỗi chỉnh sửa sản phẩm";
                }
            } else {
                echo "Lỗi sửa màu sản phẩm";
            }
        }else{
            $result = $this->productModel->updateProduct($data, $cond);
            header('Location:' . BASE_URL . "/admin/product");
        }  
    }

    public function addColorProduct(){
        $productId= $_POST['product_id'];
        $colorId= $_POST['color_id'];
        $titleProduct= $_POST['title'];
        $priceProduct= $_POST['price'];
        $quanlity= $_POST['quanlity'];

        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = time() . '.' . $file_ext;
        $path_uploads = "public/uploads/product_color/" . $unique_image;

        $colorData = array(
            'product_id' => $productId,
            'title_product' => $titleProduct,
            'color_id' => $colorId,
            'price_product' => $priceProduct,
            'quanlity' => $quanlity,
            'image' => $unique_image,
        );

        $result = $this->productModel->insertProductColor($colorData);

        if ($result) {
            move_uploaded_file($tmp_image, $path_uploads);
            $reponse=[
                'success'=>true,
                'colors' => $result,
            ];
            } else {
                $reponse=[
                    'success'=>false,
                ];
            }
        header('Content-Type: application/json');
        echo json_encode($reponse);
    }

    public function deleteColorProduct(){
        $id = $_POST['color_id_product'];
        $cond= "id='$id'";
        $result = $this->productModel->deleteColorProduct($cond);
        
        if ($result) {  
            $reponse=[
                'success'=>'true'
            ];
        }else {
            $reponse=[
                'success'=>'error'
            ];
        }
        echo json_encode($reponse);

    }

    public function search_product()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';


        $data['products'] = $this->productModel->searchProduct($keyword);

        $this->view('layout.header');
        $this->view('product.search', $data);
        $this->view('layout.footer');
    }

    public function toggleStatus($productId)
    {
        $cond = "id_product='$productId'";


        $data = array(
            'status' => '1',
        );

        $result = $this->productModel->updateProduct($data, $cond);

        if ($result) {
            $response = [
                'success' => true,
            ];
        }
        ;
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function toggleStatus2($productId)
    {
        $cond = "id_product='$productId'";


        $data = array(
            'status' => '0',
        );

        $result = $this->productModel->updateProduct($data, $cond);

        if ($result) {
            $response = [
                'success' => true,
            ];
        }
        ;
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function getBrand()
    {
        $id = $_GET['id_category_product'];
        $cond = "id_category_product='$id'";
        $brands = $this->brandModel->getBrands($cond);

        if ($brands) {
            header('Content-Type: application/json');
            echo json_encode($brands);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có nhãn hàng được cung cấp.'));
        }
    }

    public function getSeri()
    {
        $id = $_GET['id_brand'];
        $cond = "id_brand='$id'";
        $series = $this->seriModel->getSeries($cond);

        if ($series) {
            header('Content-Type: application/json');
            echo json_encode($series);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có nhãn hàng được cung cấp.'));
        }
    }


}
<?php
namespace App\Controllers;
use App\Models\AdminModel;
use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Home extends BaseController
{
    // Login Auth
    public function login(){
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password don't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation']=$this->validator;
            } 
            else {
                $model = new AdminModel();
                
                $admin = $model->where('email', $this->request->getVar('email'))
                ->first();
                if(password_verify($this->request->getVar('password'), $admin['password']))
                {
                    $this->setUserSession($admin);
                    // print_r("dfsf");die;
                    return redirect()->to('dashboard');
                }else{
                    $data['flash_message']=TRUE;
                }
            }
        }
        return view('login',$data);
    }

    // User register data backend
    public function signup() {
        $data =[];
        helper('form');

        if($this->request->getMethod()=='post'){
            // echo 222; exit;

            $rules=[
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admin.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];
            if(!$this->validate($rules)){
                $data['validation']=$this->validator;
                // echo 111; 
            }
            else{                
                // echo 1111; exit;
                $model = new AdminModel();
                $newData = array(
                    'firstname'=>$this->request->getVar('firstname'),
                    'lastname'=>$this->request->getVar('lastname'),
                    'email'=>$this->request->getVar('email'),
                    'password'=>$this->request->getVar('password'),
                );
                $model->save($newData);
                return redirect()->to('/');

                if($model->save($newData)){
                    $data['flash_message']=TRUE;
                }
            }
        }
        return view('signup',$data);
    }

    // Session datas
    private function setUserSession($admin){
        $data = [
            'id' => $admin['id'],
            'firstname' => $admin['firstname'],
            'lastname' => $admin['lastname'],
            'email' => $admin['email'],
            'isLoggedIn' => true,
        ];
        // print_r("fddf");die;
        session()->set($data);
        return true;
    }

    // Password Auth
    // private function verifyMypassword($enterpassword,$databasePassword){
    //     return password_verify($enterpassword,$databasePassword);
    // }

    // Dashboard redirection
    public function dashboard() {
        $model = new Adminmodel();
        $data['usersdata'] = $model->findAll();
        // print_r($data);
        return view('dashboard',$data);

        // 1. To select one particular columns data findAll()->gave all data first()->give the first occur data
        // $data = $model->where('user_type', 'user')->findAll();
        // echo "<pre>";
        // print_r($data);

        // 2. FindAll data in db table
        // $data = $model->findAll();
        // echo "<pre>";
        // print_r($data);

        // 3. Get the choiced datas
        // $data= $model->whereIn('id', [6,7])->get()-> 
        // $data1= $model->whereNotIn('id', [6,7])->get()->getResultArray();
        // echo "<pre>";
        // print_r($data);
        // print_r($data1);

        // 4. To get the likewise value in the table
        // $data = $model->like('firstname','ga')->get()->getResultArray();
        // echo "<pre>";
        // print_r($data);

        // 5. To store and get id 
        // $newData = array(
        //     'firstname'=>'Naveen',
        //     'lastname'=>'kumar',
        //     'email'=>'naveen@gmail.com',
        //     'password'=>'8680912417',
        // );
        // $model->insert($newData);
        // echo $model->getInsertId();
        // exit();
       
    }

    // Edit user data in the database
    public function editUser($id){
        $model = new Adminmodel();
        if($this->request->getMethod()=='post'){
            $newData = array(
                'firstname'=>$this->request->getVar('firstname'),
                'lastname'=>$this->request->getVar('lastname'),
                'email'=>$this->request->getVar('email'),
            );
            if($model->update($id,$newData)){
                return redirect()->to('dashboard');
            }
        }
        $data['userdata'] = $model->where('id',$id)
            ->first();
        // print_r($data);
        return view('editUser',$data);
    }

    // Image Upload
    // public function upload($id){
    //     $model = new Adminmodel();
    //     $data=[];
    //     if($this->request->getMethod()=='post'){
    //         $validationRule=[
    //             'userfile' => [
    //                 'label'=> 'Image File',
    //                 'rules'=>'uploaded[userfile]'
    //                 . '|is_image[userfile]'
    //                 . '|mime_in[userfile,image/jpg,image/jpeg,image/png]'
    //             ],
    //         ];
    //         if(!$this->validate($validationRule)){
    //             $data['validation'] = $this->validator;
    //         }else{
    //             // echo 1111; exit;
    //             // echo $img = $this->request->getFile('userfile');exit;
    //             $img = $this->request->getFile('userfile');
    //             if(!$img->hasMoved()){
    //                 $filepath = WRITEPATH.'uploads/'. $img->store();
    //                 $upload_fileinfo=new File($filepath);
    //                 $fileName= esc($upload_fileinfo->getBasename());
    //                 // echo $fileName;
    //                 $imagedata = array(
    //                     'image' => $fileName,
    //                 );
    //                 if($model->update($id,$imagedata)){
    //                     $data['flash_message']= TRUE;
    //                 }
    //             }
    //         }
    //     }
    //     return view('upload_form',$data);
    // }

    public function upload($id){
        $model = new Adminmodel();
        $data=[];
    
        if($this->request->getMethod()=='post'){
            $validationRule=[
                'userfile' => [
                    'label'=> 'Image File',
                    'rules'=>'uploaded[userfile]'
                            . '|is_image[userfile]'
                            . '|mime_in[userfile,image/jpg,image/jpeg,image/png]'
                ],
            ];
    
            if(!$this->validate($validationRule)){
                $data['validation'] = $this->validator;
            } else {
                $img = $this->request->getFile('userfile');
                if(!$img->hasMoved()){
                    $uploadDirectory = WRITEPATH.'uploads/';
                    $fileName = $img->getRandomName();
                    $img->move($uploadDirectory, $fileName);
                    $filePath = $uploadDirectory . $fileName;
                    $imagedata = [
                        'image' => $filePath,  // or use the full path if needed: $filePath
                    ];
    
                    // Pass the $id parameter to the update function
                    if($model->update($id, $imagedata)){
                        $data['flash_message'] = base_url('uploads/' . $fileName);
                    }
                }
            }
        }
    
        return view('upload_form', $data);
    }

    // Delete user data from database
    public function deleteUser($id){
        $model = new Adminmodel();
        if($model->where('id',$id)->delete()){
            return redirect()->to('dashboard');
        }
    }

    // Logout function
    public function logout(){
        // echo 111; exit;
        session()->destroy();
        return redirect()->to('/');
    }

    // Export excel 
    public function exportuserdata(){
        $data = [];
        $admin_model = new AdminModel();
        $fileName = 'userslist.xlsx';
        $spreadsheet = new Spreadsheet();
        // $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $users = $admin_model->findAll();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Email');
        $rows = 2;
        foreach ($users as $user){
            $sheet->setCellValue('A' . $rows, $user['id']);
            $sheet->setCellValue('B' . $rows, $user['firstname']);
            $sheet->setCellValue('C' . $rows, $user['lastname']);
            $sheet->setCellValue('D' . $rows, $user['email']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($fileName));
        flush();
        readfile($fileName);
        exit();
    }
}

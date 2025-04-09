<?php
function validateName($name) {
    if (empty($name)) {
        return "Họ và tên không được để trống";
    }
    if (strlen($name) < 3) {
        return "Họ và tên phải có ít nhất 3 ký tự";
    }
    if (strlen($name) > 50) {
        return "Họ và tên không được quá 50 ký tự";
    }
    return null;
}

function validateEmail($email) {
    if (empty($email)) {
        return "Email không được để trống";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email không hợp lệ";
    }
    if (strlen($email) > 100) {
        return "Email không được quá 100 ký tự";
    }
    return null;
}

function validatePassword($password) {
    if (empty($password)) {
        return "Mật khẩu không được để trống";
    }
    if (strlen($password) < 6) {
        return "Mật khẩu phải có ít nhất 6 ký tự";
    }
    if (strlen($password) > 50) {
        return "Mật khẩu không được quá 50 ký tự";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Mật khẩu phải chứa ít nhất 1 chữ hoa";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Mật khẩu phải chứa ít nhất 1 chữ thường";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Mật khẩu phải chứa ít nhất 1 số";
    }
    return null;
}

function validateConfirmPassword($password, $confirm_password) {
    if (empty($confirm_password)) {
        return "Xác nhận mật khẩu không được để trống";
    }
    if ($password !== $confirm_password) {
        return "Mật khẩu xác nhận không khớp";
    }
    return null;
}

function validateLogin($email, $password) {
    $errors = [];
    
    $emailError = validateEmail($email);
    if ($emailError) {
        $errors['email'] = $emailError;
    }
    
    if (empty($password)) {
        $errors['password'] = "Mật khẩu không được để trống";
    }
    
    return $errors;
}

function validateRegister($name, $email, $password, $confirm_password) {
    $errors = [];
    
    $nameError = validateName($name);
    if ($nameError) {
        $errors['name'] = $nameError;
    }
    
    $emailError = validateEmail($email);
    if ($emailError) {
        $errors['email'] = $emailError;
    }
    
    $passwordError = validatePassword($password);
    if ($passwordError) {
        $errors['password'] = $passwordError;
    }
    
    $confirmPasswordError = validateConfirmPassword($password, $confirm_password);
    if ($confirmPasswordError) {
        $errors['confirm_password'] = $confirmPasswordError;
    }
    
    return $errors;
} 
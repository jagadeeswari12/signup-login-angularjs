var app = angular.module("myApp", []);
app.controller("myctrl", function ($scope, $http, $window) {
    $scope.btnName = "login";
    $scope.showsignup = false;
    $scope.showlogin = true;

    $scope.signuppage = function () {
        $scope.showsignup = $scope.showsignup ? false : true;
        $scope.showlogin = false;
        $scope.btnName = "sign up";
        $scope.signupform.$setPristine();
        $scope.username = null;
        $scope.password = null;
        // $scope.cpassword = false;
    }
    $scope.loginpage = function () {
        $scope.showlogin = $scope.showlogin ? false : true;
        $scope.showsignup = false;
        $scope.btnName = "login";
        $scope.signupform.$setPristine();
        $scope.username = null;
        $scope.password = null;
        $scope.cpassword = null;
    }
    $scope.login = function () {
        if ($scope.btnName == "sign up") {
            if ($scope.username != null && $scope.password != null && $scope.cpassword != null) {
                $scope.postf();
            }
        } else if ($scope.btnName == "login") {
            if ($scope.username != null && $scope.password != null) {
                $scope.postf();
            }
        }
    }
    $scope.postf = function () {
        $http.post(
            "login.php", {
                'username': $scope.username,
                'password': $scope.password,
                'btnName': $scope.btnName
            }
        ).success(function (data) {
            alert(data);
            if (data == "Username already exists") {
                return;
            }
            $window.location.reload();
            if (data == "Login Successful") {
                location = "loggedin.html"
            }
        });
    }
});
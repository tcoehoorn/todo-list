//$(function() {

    //$('form#create-task').submit(function() {
    //    alert('hello world');
    //});

//// define angular module/app
//    var formApp = angular.module('formApp', []);
//
//    // create angular controller and pass in $scope and $http
//    function formController($scope, $http) {
//        $scope.formData = {};
//
//        $scope.processForm = function() {
//            alert('What');
//        }
//
//    }
////});
//
// define angular module/app
var formApp = angular.module('formApp', []);

formApp.controller('FormController', ['$scope', function($scope) {
    $scope.formData = {};

    $scope.processForm = function() {
        alert('What');
    }

}]);


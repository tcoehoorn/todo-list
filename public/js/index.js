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

formApp.controller('FormController', ['$scope', '$http', function($scope, $http) {
    $scope.formData = {};

    $scope.processForm = function() {
        $http({
          method: 'POST',
          url: '/application/index/create',
          data: $.param({test1: 'world'}),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
          // this callback will be called asynchronously
          // when the response is available
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
        });
    }
}]);



var formApp = angular.module('formApp', []);

formApp.controller('FormController', ['$scope', '$http', function($scope, $http) {
    $scope.formData = {};

    $scope.processForm = function() {
        $http({
          method: 'POST',
          url: '/application/index/create-task',
          data: $.param($scope.formData),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            $('#task-list').append('<li>' + response.data.description + '</li>');
            $scope.formData.description = '';
            $scope.formData.date = '';
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
        });
    }
}]);


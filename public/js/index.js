/*
 * Task Tracker
 */

var taskApp = angular.module('taskApp', []);

taskApp.controller('TaskController', ['$scope', '$http', function($scope, $http) {
    $scope.formData = {};

    /*
     * Save task data
     */
    $scope.saveTask = function() {
        $http({
          method: 'POST',
          url: '/application/index/save-task',
          data: $.param($scope.formData),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            // update task data
            $scope.tasks[response.data.id] = [
                response.data.id, response.data.description, response.data.date
            ];

            // reset form data
            $scope.formData.description = '';
            $scope.formData.date = '';
            $scope.formData.id = '';
            $('#save-task-hdr').text('Add New Task');
            $('#create-task button').text('Create Task');
        }, function errorCallback(response) {
        });
    }

    /*
     * Load edit task form data
     */
    $scope.loadEditForm = function(index) {
        $scope.formData.id = $scope.tasks[index][0];
        $scope.formData.description = $scope.tasks[index][1];
        $scope.formData.date = $scope.tasks[index][2];
        $('#save-task-hdr').text('Edit Task');
        $('#create-task button').text('Update');
    }
}]);


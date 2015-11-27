
var taskApp = angular.module('taskApp', []);

taskApp.controller('TaskController', ['$scope', '$http', function($scope, $http) {
    $scope.formData = {};

    $scope.processForm = function() {
        $http({
          method: 'POST',
          url: '/application/index/create-task',
          data: $.param($scope.formData),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            var id = response.data.id;
            
            if ($scope.formData.id == '') {
                $scope.tasks = $scope.tasks.concat(
                    [[response.data.id, response.data.description, response.data.date]]
                );
            } else {
                angular.forEach($scope.tasks, function(value, key) {
                    if (value[0] == id) {
                        value[1] = response.data.description;
                        value[2] = response.data.date;
                    }
                });
            }

            $scope.formData.description = '';
            $scope.formData.date = '';
            $scope.formData.id = '';
            $('#save-task-hdr').text('Add New Task');
            $('#create-task button').text('Create Task');
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
        });
    }

    $scope.loadEditForm = function(index) {
        $scope.formData.id = $scope.tasks[index][0];
        $scope.formData.description = $scope.tasks[index][1];
        $scope.formData.date = $scope.tasks[index][2];
        $('#save-task-hdr').text('Edit Task');
        $('#create-task button').text('Update');
    }
}]);


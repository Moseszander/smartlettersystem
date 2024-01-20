use `project`;

INSERT INTO `department` (`department_id`, `name`, `Head`) VALUES
('IT', 'Okoth'),
('HR', 'Ogutu'),
('Finance', 'Otieno');

INSERT INTO `levels` (`name`, `post`, `created_at`) VALUES
('clerk', 'clerk', '2023-10-17 11:08:36.000000'),
('director', 'director', '2023-10-17 11:08:36.000000'),
( 'staff', 'staff', '2023-10-17 11:09:07.000000');

INSERT INTO `staffs` (`name`, `email`, `password`, `level_id`, `created_at`, `department_id`) VALUES
('theo', 'theo@gmail.com', '123', 2, '2023-12-31 11:27:30', 3),
('jess', 'jess@gmail.com', '123', 3, '2023-12-31 12:15:31', 3),
('moses', 'moses@gmail.com', '123', 3, '2023-12-31 12:21:20', 3),
('wilson', 'wilson@gmail.com', '123', 1, '', 2);
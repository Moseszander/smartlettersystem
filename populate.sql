use `project`;

INSERT INTO `department` (`name`, `Head`) VALUES
('IT', 'Okoth'),
('HR', 'Ogutu'),
('Finance', 'Otieno');

INSERT INTO `levels` (`name`, `post`, `created_at`) VALUES
('clerk', 'clerk', '2023-10-17 11:08:36.000000'),
('director', 'director', '2023-10-17 11:08:36.000000'),
( 'staff', 'staff', '2023-10-17 11:09:07.000000');

INSERT INTO `staffs` (`name`, `email`, `password`, `level_id`, `department_id`) VALUES
('theo', 'theo@gmail.com', '123', 2, 3 ),
('jess', 'jess@gmail.com', '123', 3, 3 ),
('moses', 'moses@gmail.com', '123', 3, 3),
('wilson', 'wilson@gmail.com', '123', 1, 2),
('kimani', 'kimani@gmail.com', '123', 3, 1),
('jose', 'jose@gmail.com', '123', 3, 1),
('mary', 'mary@gmail.com', '123', 3, 1),
('leah', 'leah@gmail.com', '123', 3, 2),
('carol', 'carol@gmail.com', '123', 3, 2),
('dennis', 'dennis@gmail.com', '123', 3, 2),
('collo', 'collo@gmail.com', '123', 3, 3);

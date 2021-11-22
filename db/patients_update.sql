
​
CREATE TABLE patients_update (
  c_id varchar(50) NOT NULL,
  c_name varchar(300) NOT NULL,
  c_birth varchar(300) DEFAULT NULL,
  c_address varchar(500) DEFAULT NULL,
  dx1 varchar(100) NOT NULL,
  cdr varchar(100) NOT NULL,
  homehobb varchar(100) NOT NULL,
  judgement varchar(100) NOT NULL,
  memory varchar(100) NOT NULL,
  orient varchar(100) NOT NULL,
  commun varchar(100) NOT NULL,
  persare varchar(100) NOT NULL,
  MR_scanner varchar(500) DEFAULT NULL,
  t1w_url varchar(500) DEFAULT NULL,
  t2w_url varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
​

​
INSERT INTO `patients_update` (`c_id`, `c_name`, `c_birth`, `c_address`, `dx1`, `cdr`, `homehobb`, `judgement`, `memory`, `orient`, `commun`, `persare`, `MR_scanner`, `t1w_url`, `t2w_url`) VALUES
('demo0', 'j/zTFEYxCb7eZlcB5T9qAw==', 'j/zTFEYxCb7eZlcB5T9qAw==', 'j/zTFEYxCb7eZlcB5T9qAw==', 'j/zTFEYxCb7eZlcB5T9qAw==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', 'JrI2QAkDdebjWSm3ejYwzQ==', '0', '', ''),
('demo0.5', '+JMX5BGlBzuGwOtY4D+2ug==', '+JMX5BGlBzuGwOtY4D+2ug==', '+JMX5BGlBzuGwOtY4D+2ug==', '+JMX5BGlBzuGwOtY4D+2ug==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', 'gEbWuQJ+yUVLjTineGv9ww==', '0.5', '', ''),
('demo1', 'tz6N3Ik5hDlntUikSkH7ng==', 'tz6N3Ik5hDlntUikSkH7ng==', 'tz6N3Ik5hDlntUikSkH7ng==', 'tz6N3Ik5hDlntUikSkH7ng==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', 'fXGrqW3sjm4fYhFbsy76Gg==', '1', '', ''),
('demo2', 'yBofUElb4wg0GzgtLuBB6w==', 'yBofUElb4wg0GzgtLuBB6w==', 'yBofUElb4wg0GzgtLuBB6w==', 'yBofUElb4wg0GzgtLuBB6w==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '6Basu1s3J++3iWnMHuK1mg==', '2', '', ''),
('demo3', 'EQTSg+DYySoi7jJ2Tn3Beg==', 'EQTSg+DYySoi7jJ2Tn3Beg==', 'EQTSg+DYySoi7jJ2Tn3Beg==', 'EQTSg+DYySoi7jJ2Tn3Beg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '+KaNeA+goFE+/xKWcIk1gg==', '3', '', '');
​

ALTER TABLE `patients_update`
  ADD PRIMARY KEY (`c_id`);
COMMIT;

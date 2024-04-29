SELECT * 
  FROM crime_scene_report
  where city = 'SQL City'
  and type = 'murder'

-- 20180115	murder	Security footage shows that there were 2 witnesses. 
-- 			The first witness lives at the last house on "Northwestern Dr". 
-- 			The second witness, named Annabel, lives somewhere on "Franklin Ave". SQL City

SELECT *, MAX(address_number) max_adresse
  FROM person 
  where address_street_name = 'Northwestern Dr'
	or (address_street_name = 'Franklin Ave' and name like 'Annabel%')
  group by address_street_name 

-- id	name	license_id	address_number	address_street_name	ssn	max_adresse
-- 16371	Annabel Miller	490173	103	Franklin Ave	318771143	103
-- 14887	Morty Schapiro	118009	4919	Northwestern Dr	111564949	4919

SELECT * 
  FROM interview 
  where person_id = 16371 or person_id = 14887

--   person_id	transcript
-- 14887	I heard a gunshot and then saw a man run out. He had a "Get Fit Now Gym" bag. 
--        The membership number on the bag started with "48Z". Only gold members have 
--        those bags. The man got into a car with a plate that included "H42W".
-- 16371	I saw the murder happen, and I recognized the killer from my gym when I was 
--        working out last week on January the 9th.

SELECT p.* 
  FROM person p join drivers_license d on d.id = p.license_id
  	join get_fit_now_member g on g.person_id = p.id
	join get_fit_now_check_in c on c.membership_id = g.id
  where g.id like '48Z%' and d.plate_number like '%H42W%'

--   id	name	license_id	address_number	address_street_name	ssn
--  67318	Jeremy Bowers	423327	530	Washington Pl, Apt 3A	871539279

INSERT INTO solution VALUES (1, 'Jeremy Bowers');
        
        SELECT value FROM solution;

--  value
--  Congrats, you found the murderer! But wait, there's more... If you think you're up 
--  for a challenge, try querying the interview transcript of the murderer to find the 
--  real villain behind this crime. If you feel especially confident in your SQL skills, 
--  try to complete this final step with no more than 2 queries. 
--  Use this same INSERT statement with your new suspect to check your answer.

SELECT * 
  FROM interview 
  where person_id = 67318

-- person_id	transcript
-- 67318	I was hired by a woman with a lot of money. 
--       I don't know her name but I know she's around 5'5" (65") or 5'7" (67"). 
--       She has red hair and she drives a Tesla Model S. 
--       I know that she attended the SQL Symphony Concert 3 times in December 2017. 

SELECT p.* 
  FROM person p join drivers_license d on d.id = p.license_id
  	join facebook_event_checkin f on f.person_id = p.id
  where d.hair_color = 'red' and car_make = 'Tesla' and car_model = 'Model S'
  	and height between 65 and 67 
    and f.date like '201712%' and event_name = 'SQL Symphony Concert' 
  group by p.id
  having count(f.person_id) = 3 

-- id	name	license_id	address_number	address_street_name	ssn
-- 99716	Miranda Priestly	202298	1883	Golden Ave	987756388

INSERT INTO solution VALUES (1, 'Miranda Priestly');
        
        SELECT value FROM solution;

-- value
-- Congrats, you found the brains behind the murder! Everyone in SQL City hails you 
-- as the greatest SQL detective of all time. Time to break out the champagne!
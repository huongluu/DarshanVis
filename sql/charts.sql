select 
sum(total_bytes) as totalBytes,count(id) as jobsCount, uid
from 
jobs_info where total_bytes < 1000000 group by uid order by totalBytes desc ;


select 
avg(total_bytes) as avg_bytes, max(total_bytes) as max_bytes , uid
from 
jobs_info group by uid order by avg_bytes desc ;

set @csum := 0;
select id, unique_iotime, (@csum := @csum + unique_iotime) as cumulative_iotime
from jobs_info
order by unique_iotime desc;
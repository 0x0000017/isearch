export class Users
{
	worker_id : string;
	worker_name : string;
	worker_desc: string;
	worker_category: string;
	worker_address: string;

	constructor(worker_id, worker_name, worker_desc, worker_category,worker_address)  {
		this.worker_id = worker_id;
		this.worker_name = worker_name;
		this.worker_desc = worker_desc;
		this.worker_category = worker_category;
		this.worker_address = worker_address;
	}
}
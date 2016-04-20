lib.registration = COA
lib.registration {
	10 = CONTENT
	10.table = tt_content
	10.select {
		pidInList = 19
		uidInList = 19, 20
		orderBy = uid
	}
}

lib.waitinglist = COA
lib.waitinglist {
	10 = CONTENT
	10.table = tt_content
	10.select {
		pidInList = 19
		uidInList = 19, 35, 41
		orderBy = uid
	}
}

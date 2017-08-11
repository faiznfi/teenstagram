import csv
word_counter = {}
hasil=[]
with open('data/2.data_training_with_stem.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        for kata in row:
        # asli= ' '.join(row)
            hasil.append(kata)
# print(hasil)
for word in hasil:
	if word in word_counter:
		word_counter[word] += 1
	else:
		word_counter[word] = 1

popular_words = sorted(word_counter, key = word_counter.get, reverse = True)

top_100 = popular_words[:2000]
print(top_100)


with open('4.kata_dibuang.csv', 'w', newline='') as tulisFile:
    tulisFileWriter = csv.writer(tulisFile)
    for row in top_100:
        tulisFileWriter.writerow([row])
tulisFile.close()
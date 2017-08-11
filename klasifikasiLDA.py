import gensim
from gensim.corpora import MmCorpus, Dictionary

import sys
sys.stdout = open('model/no_stem/model_2_30_nostem.model', 'w')

# Load  model.
filename = 'model/stem/model_3_30_stem.model'
model = gensim.models.LdaModel.load(filename)

# print model
for i in range(0, model.num_topics):
    print(model.print_topic(i))

#-------------------------------------------------------#

# Klasifikasi data
dictionary = Dictionary.load("dictionary/dictionary.dict")
corpus = MmCorpus("dictionary/corpora.mm")

tweet = open('data/1.data_tes.csv')
#fbComment = open('input/fb_comments.csv')

listAgregat = []
for i in tweet:
    listAgregat.append(i)


k = 4;
listDocument = [[] for z in range(k)]

# listDocument = []
listTopicNo = []
for document in listAgregat:
    # print document
    document1 = document.split()
    # print document1
    document2 = dictionary.doc2bow(document1)
    # print document2
    print(model[document2])

    a = list(sorted(model[document2], key=lambda x: x[1]))
   # print(a[-1])
    topicNo, probability = a[-1]
    if probability > 0.95:
        listDocument[topicNo].append(document)
    listTopicNo.append(topicNo)
    #print(document)

b = sorted(listTopicNo)
# print b[-1]

for topicNo in range(b[0], b[-1]+1): #b[-1]+1
    judul = "Topic #" + str(topicNo)
    # print judul + " : " + str(listDocument[topicNo])

for topicNo in range(b[0], b[-1]+1):
    print("Topic #" + str(topicNo))
    for document in listDocument[topicNo]:
        print(document)
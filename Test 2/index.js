const rl = require('readline').createInterface({
    input: process.stdin,
    output: process.stdout,
});

const input = (text) => {
    return new Promise((resolve, reject) => {
        rl.question(text, (player) => {
            resolve(player);
        })
    })
}

const main = async () => {
    const countPlayer = await input("Count : ");
    const scores = [];
    for (let i = 0; i < countPlayer; i++) {
        scores.push(parseInt(await input("Score : ")));
    }
    const countScore = await input("Count : ");
    const sortedScores = scores.sort((a, b) => b - a);
    const myScores = [];
    for (let i = 0; i < countScore; i++) {
        myScores.push(parseInt(await input("Score : ")));
    }
    rl.close();
    console.log(sortedScores, myScores);
    // Process Dense Ranking
    const ranks = [];
    myScores.forEach(my => {
        let rank = 1;
        sortedScores.forEach((score, i) => {
            if (sortedScores.length - 1 !== i) {
                if (score !== sortedScores[i + 1] && my < score) {
                    rank++;
                }
            }
        });
        if (my < sortedScores[sortedScores.length - 1]) {
            rank++;
        }
        ranks.push(rank);
    });
    console.log(ranks);
}

main()
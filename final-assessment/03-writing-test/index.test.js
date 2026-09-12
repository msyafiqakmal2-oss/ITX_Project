import { test } from 'node:test';
import assert from 'node:assert';
import { sum } from './index.js';

test('should return the sum of two positive numbers', () => {
  const result = sum(2, 3);
  assert.strictEqual(result, 5);
});

test('should return the sum of two negative numbers', () => {
  const result = sum(-2, -3);
  assert.strictEqual(result, -5);
});

test('should return the sum of a positive and a negative number', () => {
  const result = sum(5, -3);
  assert.strictEqual(result, 2);
});

test('should return the same number when adding zero', () => {
  const result = sum(10, 0);
  assert.strictEqual(result, 10);
});